"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Helpers_1 = global[Symbol.for('ioc.use')]("Adonis/Core/Helpers");
const Drive_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Core/Drive"));
const Mail_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Addons/Mail"));
const Validator_1 = global[Symbol.for('ioc.use')]("Adonis/Core/Validator");
const ApiReporters_1 = global[Symbol.for('ioc.use')]("App/Validators/Reporters/ApiReporters");
const Hash_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Core/Hash"));
const User_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/User"));
const DocumentExtraField_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/DocumentExtraField"));
const DocumentFile_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/DocumentFile"));
class AuthController {
    async Login({ request, auth, response }) {
        await request.validate({
            schema: Validator_1.schema.create({
                email: Validator_1.schema.string({ trim: true }, [Validator_1.rules.email()]),
                password: Validator_1.schema.string({ trim: true }),
            }),
            messages: {
                'email.required': 'The {{ field }} is required',
                'email': 'The {{ field }} is not valid email id',
                'password.required': 'The  {{ field }} is required',
            },
            reporter: ApiReporters_1.ApiReporters,
        });
        const email = request.input("email");
        const password = request.input("password");
        let User_response = {};
        let userdata = await User_1.default
            .query()
            .preload('document_data')
            .preload('document_data', (postsQuery) => {
            postsQuery.preload('document_file');
        })
            .where('email', email)
            .first();
        if (userdata) {
            if (!(await Hash_1.default.verify(userdata.password, password))) {
                let response_data = {
                    success: false,
                    errors: {
                        "message": "Password not matched, please try again.",
                    }
                };
                return response.json(response_data);
            }
            const token = await auth.use('api').generate(userdata, {
                expiresIn: '180 days'
            });
            User_response.user = userdata.toJSON();
            User_response.user.token_type = token.toJSON().type;
            User_response.user.token = token.toJSON().token;
            await User_1.default.query().where('id', userdata.id).update({
                device_token: request.input('device_token'),
                device_type: request.input('device_type')
            });
            delete User_response.user.password;
            let response_data = {
                status: true,
                data: User_response,
                message: "",
            };
            return response.json(response_data);
        }
        else {
            let response_data = {
                success: false,
                errors: {
                    "message": "This email is not registered, please sign up to use the application.",
                }
            };
            return response.json(response_data);
        }
    }
    async Register({ request, auth, response }) {
        await request.validate({
            schema: Validator_1.schema.create({
                email: Validator_1.schema.string({ trim: true }, [Validator_1.rules.unique({ table: 'users', column: 'email', caseInsensitive: true, })]),
                password: Validator_1.schema.string({ trim: true }),
            }),
            messages: {
                'email': 'The {{ field }} is required to create a new account',
                'email.unique': '{{ field }} already registered',
                'password.required': 'You must provide a password',
            },
            reporter: ApiReporters_1.ApiReporters,
        });
        let Userdata = request.all();
        Userdata.otp = Math.random().toString().substr(2, 6);
        delete Userdata.files;
        let document_extra = {};
        document_extra.license_number = Userdata.license_number;
        document_extra.insurance_company = Userdata.insurance_company;
        document_extra.inventory_coverage_amount = Userdata.inventory_coverage_amount;
        delete Userdata.license_number;
        delete Userdata.insurance_company;
        delete Userdata.inventory_coverage_amount;
        let user_data_get = await User_1.default.create(Userdata);
        document_extra.user_id = user_data_get.id;
        let document_field = await DocumentExtraField_1.default.create(document_extra);
        const images = request.files('files');
        for (let image of images) {
            let new_name = Helpers_1.string.generateRandom(32);
            let full_new_name = `${new_name}.${image.subtype}`;
            await image.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = image.fileName;
            const url = await Drive_1.default.getUrl(fileName);
            DocumentFile_1.default.create({
                user_id: user_data_get.id,
                document_id: document_field.id,
                document_url: url,
            });
        }
        let user_data = await User_1.default.findBy('id', user_data_get.id);
        const token = await auth.use("api").login(user_data_get, {
            expiresIn: "180 days",
        });
        Object.assign(user_data, token);
        let response_data = {
            status: true,
            data: user_data,
            message: "",
        };
        return response.json(response_data);
    }
    async Otp_verify({ request, response }) {
        await request.validate({
            schema: Validator_1.schema.create({
                otp: Validator_1.schema.string({ trim: true }),
            }),
            messages: {
                'otp': 'The {{ field }} is required',
            },
            reporter: ApiReporters_1.ApiReporters,
        });
        let Userdata = request.all();
        let verify = await User_1.default.query().where('otp', Userdata.otp).first();
        if (verify) {
            await User_1.default.query().where('id', verify.id).update({ status: '1' });
            let response_data = {
                status: true,
                data: [],
                message: "successfully verify otp",
            };
            return response.json(response_data);
        }
        else {
            let response_data = {
                status: false,
                data: [],
                message: "invalid otp",
            };
            return response.json(response_data);
        }
    }
    async Forgot_password({ request, response }) {
        let User_email = request.all();
        let Userdata = {};
        Userdata = await User_1.default.query().where('email', User_email.email).first();
        if (Userdata) {
            let token = Helpers_1.string.generateRandom(32);
            await User_1.default.query().where('id', Userdata.id).update({
                forgot_token: token
            });
            await Mail_1.default.send((message) => {
                message
                    .from('sajinhentry@syskode.com')
                    .to(Userdata.email)
                    .subject('OTP email')
                    .htmlView('emails/otp', {
                    name: Userdata.first_name + " " + Userdata.last_name,
                    otp: token,
                });
            });
            let response_data = {
                status: true,
                data: [],
                message: "successfully verify otp",
            };
            return response.json(response_data);
        }
        else {
            let response_data = {
                status: false,
                data: [],
                message: "invalid email",
            };
            return response.json(response_data);
        }
    }
    async Reset_password({ request, response }) {
        let Userdata = request.all();
        let password = await Hash_1.default.make(Userdata.password);
        await User_1.default.query().where('email', Userdata.email).update({
            password: password
        });
        let response_data = {
            status: true,
            data: [],
            message: "successfully reset password",
        };
        return response.json(response_data);
    }
    async New_password({ request, response }) {
        let Userdata = request.all();
        let password = await Hash_1.default.make(Userdata.password);
        await User_1.default.query().where('forgot_token', Userdata.token).update({
            password: password,
            forgot_token: ""
        });
        let response_data = {
            status: true,
            data: [],
            message: "successfully reset password",
        };
        return response.json(response_data);
    }
    async Check_token({ request, response }) {
        let Userdata = request.all();
        let responsemsg = {
            token_valid: false,
        };
        let check_token = await User_1.default.query().where('forgot_token', Userdata.token).first();
        if (check_token) {
            responsemsg.token_valid = true;
        }
        let response_data = {
            status: true,
            data: responsemsg,
            message: "",
        };
        return response.json(response_data);
    }
}
exports.default = AuthController;
//# sourceMappingURL=AuthController.js.map