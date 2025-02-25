"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Database_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Database"));
const Helpers_1 = global[Symbol.for('ioc.use')]("Adonis/Core/Helpers");
const Drive_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Core/Drive"));
const Validator_1 = global[Symbol.for('ioc.use')]("Adonis/Core/Validator");
const ApiReporters_1 = global[Symbol.for('ioc.use')]("App/Validators/Reporters/ApiReporters");
const Hash_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Core/Hash"));
const moment = require('moment');
const FCM = require('fcm-node');
const User_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/User"));
const CreditCard_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/CreditCard"));
const Category_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/Category"));
const Auction_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/Auction"));
const AuctionBid_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/AuctionBid"));
const AuctionMedia_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/AuctionMedia"));
const FilterList_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/FilterList"));
const Banner_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/Banner"));
const AdminCommission_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/AdminCommission"));
const WishList_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/WishList"));
const SearchSave_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/SearchSave"));
const Notification_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/Notification"));
const DocumentExtraField_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/DocumentExtraField"));
const DocumentFile_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/DocumentFile"));
const BidSetting_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/BidSetting"));
class UsersController {
    async Userdata({ request, auth, response }) {
        const language = request.languages();
        console.log(language);
        let authdata = await auth.use('api').authenticate();
        let Userdata = await User_1.default.query().preload('document_data')
            .preload('document_data', (postsQuery) => {
            postsQuery.preload('document_file');
        })
            .where('id', authdata.id);
        let response_data = {
            status: true,
            data: Userdata,
            message: "",
        };
        return response.json(response_data);
    }
    async Update_profile({ request, auth, response }) {
        const language = request.languages();
        console.log(language);
        let authdata = await auth.use('api').authenticate();
        let Userdata = request.all();
        delete Userdata.profile_url;
        delete Userdata.email;
        delete Userdata.password;
        if (request.file('profile_url')) {
            const image = request.file('profile_url');
            let new_name = Helpers_1.string.generateRandom(32);
            let full_new_name = `${new_name}.${image?.subtype}`;
            await image?.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = image?.fileName;
            Userdata.profile_url = await Drive_1.default.getUrl(fileName);
        }
        await User_1.default.query().where('id', authdata.id).update(Userdata);
        let response_data = {
            status: true,
            data: [],
            message: "successfully updated.",
        };
        return response.json(response_data);
    }
    async Update_document_data({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let Userdata = request.all();
        let id = request.input('id');
        delete Userdata.id;
        await DocumentExtraField_1.default.query().where('id', id).where('user_id', authdata.id).update(Userdata);
        let response_data = {
            status: true,
            data: [],
            message: "successfully updated document data.",
        };
        return response.json(response_data);
    }
    async Update_document_file({ request, response }) {
        const id = request.input('id');
        if (request.file('file')) {
            const image = request.file('file');
            let new_name = Helpers_1.string.generateRandom(32);
            let full_new_name = `${new_name}.${image?.subtype}`;
            await image?.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = image?.fileName;
            const url = await Drive_1.default.getUrl(fileName);
            await DocumentFile_1.default.query().where('id', id).update({
                document_url: url,
                status: "0"
            });
        }
        let response_data = {
            status: true,
            data: [],
            message: "successfully update document file",
        };
        return response.json(response_data);
    }
    async Add_document_file({ request, auth, response }) {
        const document_id = request.input('document_id');
        let authdata = await auth.use('api').authenticate();
        if (request.file('file')) {
            const image = request.file('file');
            let new_name = Helpers_1.string.generateRandom(32);
            let full_new_name = `${new_name}.${image?.subtype}`;
            await image?.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = image?.fileName;
            const url = await Drive_1.default.getUrl(fileName);
            await DocumentFile_1.default.create({
                user_id: authdata.id,
                document_id: document_id,
                document_url: url,
            });
        }
        let response_data = {
            status: true,
            data: [],
            message: "successfully added document file",
        };
        return response.json(response_data);
    }
    async Cardsave({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let Cardata = request.all();
        Cardata.user_id = authdata.id;
        await CreditCard_1.default.create(Cardata);
        let response_data = {
            status: true,
            data: [],
            message: "successfully added card details",
        };
        return response.json(response_data);
    }
    async Change_password({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let Userdata = request.all();
        let password = await Hash_1.default.make(Userdata.password);
        await User_1.default.query().where('id', authdata.id).update({
            password: password
        });
        let response_data = {
            status: true,
            data: [],
            message: "successfully update password",
        };
        return response.json(response_data);
    }
    async Logout({ auth, response }) {
        let authdata = await auth.use('api').authenticate();
        await User_1.default.query().where('id', authdata.id).update({
            device_token: "",
            device_type: "android"
        });
        let response_data = {
            status: true,
            data: [],
            message: "successfully logout",
        };
        return response.json(response_data);
    }
    async Get_Card_detail({ auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let Userdata = await CreditCard_1.default.query().where('user_id', authdata.id).first();
        let response_data = {
            status: true,
            data: Userdata,
            message: "",
        };
        return response.json(response_data);
    }
    async Dashboard({ request, response }) {
        const language = request.languages();
        let current_date = moment().format('YYYY-MM-DD');
        let end_date = moment().add(1, 'days').format('YYYY-MM-DD');
        let dashboard_data = {};
        dashboard_data.banner_list = await Banner_1.default.query().where('status', '1');
        dashboard_data.latest_offer = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').preload('userdata');
        })
            .where('status', '2')
            .where('latest_offer', '1')
            .where('bid_end', '>=', current_date);
        dashboard_data.newly_listed = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata');
        })
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').preload('userdata');
        })
            .where('status', '2')
            .where('created_at', '>=', current_date);
        dashboard_data.tranding = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').preload('userdata');
        })
            .where('status', '2')
            .where('created_at', '>=', current_date);
        dashboard_data.auction_ending = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').preload('userdata');
        })
            .where('status', '2')
            .whereBetween('bid_end', [current_date, end_date]);
        dashboard_data.bidsetting = await BidSetting_1.default.query().where('status', '1');
        let response_data = {
            status: true,
            data: dashboard_data,
            message: "",
        };
        return response.json(response_data);
    }
    async Auction_search_filter({ request, response }) {
        const language = request.languages();
        let current_date = moment().format('YYYY-MM-DD');
        const page = request.input('page', 1);
        const limit = 10;
        let { used_type, lat, lng, make, model, year, mileage, damage_type, secondary_damage_type, drive_line_type, body_type, fuel_type, transmission, color, catalytic_convertor, km_range, bid_end, bid_start, search_end, starting_bid, end_bid } = request.all();
        const query = Auction_1.default.query();
        if (used_type != undefined && used_type != "") {
            query.where('used_type', used_type);
        }
        if (make != undefined && make != "") {
            query.where('make', make);
        }
        if (model != undefined && model != "") {
            query.where('model', model);
        }
        if (year != undefined && year != "") {
            query.where('year', year);
        }
        if (mileage != undefined && mileage != "") {
            query.where('mileage', mileage);
        }
        if (damage_type != undefined && damage_type != "") {
            query.where('damage_type', damage_type);
        }
        if (secondary_damage_type != undefined && secondary_damage_type != "") {
            query.where('secondary_damage_type', secondary_damage_type);
        }
        if (drive_line_type != undefined && drive_line_type != "") {
            query.where('drive_line_type', drive_line_type);
        }
        if (body_type != undefined && body_type != "") {
            query.where('body_type', body_type);
        }
        if (fuel_type != undefined && fuel_type != "") {
            query.where('fuel_type', fuel_type);
        }
        if (transmission != undefined && transmission != "") {
            query.where('transmission', transmission);
        }
        if (color != undefined && color != "") {
            query.where('color', color);
        }
        if (catalytic_convertor != undefined && catalytic_convertor != "") {
            query.where('catalytic_convertor', catalytic_convertor);
        }
        if ((lat != undefined && lng != undefined && km_range != undefined) && (lat != "" && lng != "" && km_range != "")) {
            console.log("in lat lng");
            const distanceInMilesSql = '(6371 * acos( cos( radians(' + lat + ') ) * cos( radians(lat) ) * cos( radians(lng)- radians(' + lng + ')) + sin(radians(' + lat + ')) * sin(radians(lat)) )) as distance';
            query.whereHas('distance_data', (distancedataQuery) => {
                distancedataQuery.select(Database_1.default.raw(distanceInMilesSql)).having('distance', '<', km_range);
            });
        }
        if (bid_start != undefined && bid_start != "") {
            query.where('bid_start', '<=', bid_start);
        }
        if (bid_end != undefined && bid_end != "") {
            query.where('bid_end', '>=', bid_end);
        }
        else if (search_end != undefined && search_end != "") {
            query.where('bid_end', search_end);
        }
        else {
            query.where('bid_end', '>=', current_date);
        }
        if (starting_bid != undefined && starting_bid != "") {
            query.where('bid_price', '<=', starting_bid);
        }
        if (end_bid != undefined && end_bid != "") {
            query.where('sale_price', '<=', end_bid);
        }
        let search_result = await query
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .orderBy('bid_end', 'desc')
            .where('status', '2')
            .paginate(page, limit);
        let response_data = {
            status: true,
            data: search_result,
            message: "search ",
        };
        return response.json(response_data);
    }
    async Auction_search({ request, response }) {
        const language = request.languages();
        let current_date = moment().format('YYYY-MM-DD');
        const page = request.input('page', 1);
        const limit = 10;
        let { search_q } = request.all();
        const query = Auction_1.default.query();
        let search_result = await query
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .orWhereHas('make_name', (sub_query) => {
            sub_query.orWhere((sub_query_i) => {
                sub_query_i.where('language', language[0]).where('name', 'like', '%' + search_q + '%');
            });
        })
            .orWhereHas('model_name', (sub_query) => {
            sub_query.orWhere((sub_query_i) => {
                sub_query_i.where('language', language[0]).where('name', 'like', '%' + search_q + '%');
            });
        })
            .orWhere('vin', 'like', '%' + search_q + '%')
            .orWhere('year', search_q)
            .where('bid_end', '>=', current_date)
            .orderBy('bid_end', 'desc')
            .where('status', '2')
            .paginate(page, limit);
        let response_data = {
            status: true,
            data: search_result,
            message: "search ",
        };
        return response.json(response_data);
    }
    async Get_category({ request, response }) {
        const language = request.languages();
        let category_data = await Category_1.default.query()
            .preload('cateogry_name', (profileQuery) => {
            profileQuery.where('language', language[0]);
        })
            .where('is_parent', '0')
            .where('status', '1');
        let response_data = {
            status: true,
            data: { category: category_data },
            message: "cateogry list",
        };
        return response.json(response_data);
    }
    async Get_sub_category({ request, response, params }) {
        const language = request.languages();
        let category_data = await Category_1.default.query()
            .preload('cateogry_name', (profileQuery) => {
            profileQuery.where('language', language[0]);
        })
            .where('is_parent', params.id)
            .where('status', '1');
        let response_data = {
            status: true,
            data: { category: category_data },
            message: "sub cateogry list",
        };
        return response.json(response_data);
    }
    async Auction_filter_list({ request, response }) {
        let language = request.languages();
        let category_data = await FilterList_1.default.query()
            .where('status', '1')
            .preload('filter_lable', (profileQuery) => {
            profileQuery.where('language', language[0]);
        })
            .preload('filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]);
        });
        let response_data = {
            status: true,
            data: category_data,
            message: "successfully filter list",
        };
        return response.json(response_data);
    }
    async New_auction({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let Auction_data = request.all();
        Auction_data.user_id = authdata.id;
        delete Auction_data.image_file;
        delete Auction_data.video_file;
        let New_auction = await Auction_1.default.create(Auction_data);
        const images = request.files('image_file');
        for (let image of images) {
            let new_name = Helpers_1.string.generateRandom(40);
            let full_new_name = `${new_name}.${image.subtype}`;
            await image.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = image.fileName;
            const url = await Drive_1.default.getUrl(fileName);
            await AuctionMedia_1.default.create({
                auction_id: New_auction.id,
                media_url: url,
            });
        }
        const videos = request.files('video_file');
        for (let video of videos) {
            let new_name = Helpers_1.string.generateRandom(40);
            let full_new_name = `${new_name}.${video.subtype}`;
            await video.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = video.fileName;
            const url = await Drive_1.default.getUrl(fileName);
            AuctionMedia_1.default.create({
                auction_id: New_auction.id,
                media_url: url,
                type: 'video',
            });
        }
        let response_data = {
            status: true,
            data: [],
            message: "successfully add new auction",
        };
        return response.json(response_data);
    }
    async Update_auction({ request, auth, response, params }) {
        let authdata = await auth.use('api').authenticate();
        let Auction_data = request.all();
        delete Auction_data.image_file;
        delete Auction_data.video_file;
        Auction_data.status = "1";
        await Auction_1.default.query().where('id', params.auction_id).update(Auction_data);
        const images = request.files('image_file');
        for (let image of images) {
            let new_name = Helpers_1.string.generateRandom(40);
            let full_new_name = `${new_name}.${image.subtype}`;
            await image.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = image.fileName;
            const url = await Drive_1.default.getUrl(fileName);
            await AuctionMedia_1.default.create({
                auction_id: params.auction_id,
                media_url: url,
            });
        }
        const videos = request.files('video_file');
        for (let video of videos) {
            let new_name = Helpers_1.string.generateRandom(40);
            let full_new_name = `${new_name}.${video.subtype}`;
            await video.moveToDisk('./', {
                name: full_new_name,
                overwrite: true,
            });
            const fileName = video.fileName;
            const url = await Drive_1.default.getUrl(fileName);
            AuctionMedia_1.default.create({
                auction_id: params.auction_id,
                media_url: url,
                type: 'video',
            });
        }
        let seller_msg = {
            title: "Zunkie Auto",
            body: "You have successfully updated auction",
            user_id: authdata.id,
            auction_id: params.auction_id,
            type: "seller"
        };
        await this.SendFcmNotification(authdata.id, seller_msg);
        await Notification_1.default.create({
            user_id: authdata.id,
            notification: seller_msg.body,
        });
        let response_data = {
            status: true,
            data: [],
            message: "successfully update auction",
        };
        return response.json(response_data);
    }
    async Closed_auction({ request, auth, response, params }) {
        let authdata = await auth.use('api').authenticate();
        let User_request = request.all();
        await Auction_1.default.query().where('id', params.auction_id).where('user_id', authdata.id).update({
            status: User_request.status,
            cancel_by: "owner"
        });
        let Auction_bid = {};
        Auction_bid = await AuctionBid_1.default.query().where('auction_id', params.auction_id);
        Auction_bid.map(async (user) => {
            let buyer_msg = {
                title: "Zunkie Auto",
                body: "Bid closed",
                user_id: user.user_id,
                auction_id: params.auction_id,
                type: "buyer"
            };
            await this.SendFcmNotification(user.user_id, buyer_msg);
            await Notification_1.default.create({
                user_id: user.user_id,
                notification: buyer_msg.body,
            });
        });
        let response_data = {
            status: true,
            data: [],
            message: "successfully close auction",
        };
        return response.json(response_data);
    }
    async Remove_auction_media({ response, params }) {
        await AuctionMedia_1.default.query().where('id', params.id).delete();
        let response_data = {
            status: true,
            data: [],
            message: "successfully deleted media",
        };
        return response.json(response_data);
    }
    async My_auction_list({ request, auth, response }) {
        let language = request.languages();
        let authdata = await auth.use('api').authenticate();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data')
            .where('user_id', authdata.id)
            .orderBy('id', 'desc');
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "my auction list",
        };
        return response.json(response_data);
    }
    async My_expried_auction({ request, auth, response }) {
        let language = request.languages();
        let authdata = await auth.use('api').authenticate();
        let current_date = moment().format('YYYY-MM-DD');
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data')
            .where('user_id', authdata.id)
            .where('bid_end', '<', current_date)
            .where('status', '2')
            .orderBy('id', 'desc');
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "my expired auction list",
        };
        return response.json(response_data);
    }
    async All_auction_list({ request, response }) {
        let language = request.languages();
        const page = request.input('page', 1);
        const limit = 10;
        let current_date = moment().format('YYYY-MM-DD');
        let my_auction_list = {};
        my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .preload('maxPreBid', (profileQuery) => {
            profileQuery.orderBy('id', 'desc')
                .preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .orderBy('id', 'desc')
            .where('bid_end', '>=', current_date)
            .where('status', '2')
            .paginate(page, limit);
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "all auction list",
        };
        return response.json(response_data);
    }
    async Auction_details({ request, response, params }) {
        let language = request.languages();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .preload('maxPreBid', (profileQuery) => {
            profileQuery
                .orderBy('id', 'desc')
                .preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .where('id', params.auction_id)
            .first();
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "auction details",
        };
        return response.json(response_data);
    }
    async Auction_details_with_login({ request, auth, response, params }) {
        let language = request.languages();
        let authdata = await auth.use('api').authenticate();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.where('user_id', authdata.id).preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .preload('maxPreBid', (profileQuery) => {
            profileQuery.select('bid_amount', 'user_id')
                .orderBy('id', 'desc')
                .preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').where('user_id', authdata.id).preload('userdata');
        })
            .where('id', params.auction_id)
            .first();
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "auction details",
        };
        return response.json(response_data);
    }
    async My_auction_details({ request, auth, response, params }) {
        let language = request.languages();
        let authdata = await auth.use('api').authenticate();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data')
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').preload('userdata');
        })
            .where('id', params.auction_id)
            .where('user_id', authdata.id)
            .first();
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "auction details",
        };
        return response.json(response_data);
    }
    async Bid({ request, auth, response }) {
        await request.validate({
            schema: Validator_1.schema.create({
                auction_id: Validator_1.schema.number(),
                bid_amount: Validator_1.schema.number(),
                type: Validator_1.schema.string({ trim: true }),
            }),
            messages: {
                'auction_id.required': 'The {{ field }} is required',
                'bid_amount': 'The {{ field }} is required',
                'type': 'The {{ field }} is required',
            },
            reporter: ApiReporters_1.ApiReporters,
        });
        let authdata = await auth.use('api').authenticate();
        let Biddata = request.all();
        Biddata.user_id = authdata.id;
        let Auction_data = {};
        Auction_data = await Auction_1.default.query().where('id', Biddata.auction_id).first();
        let User_data = {};
        User_data = await User_1.default.query().where('id', authdata.id).first();
        if (Biddata.bid_amount >= Auction_data?.bid_price) {
            if (Biddata.type == 'pre_bid') {
                let Last_pre_bid = {};
                Last_pre_bid = await AuctionBid_1.default.query().where('auction_id', Biddata.auction_id).where('type', 'pre_bid').orderBy('id', 'desc').first();
                if (Last_pre_bid) {
                    if (Biddata?.bid_amount > Last_pre_bid?.bid_amount) {
                        await AuctionBid_1.default.create(Biddata);
                        let seller_msg = {
                            title: "Zunkie Auto",
                            body: User_data.first_name + " " + User_data.last_name + " has made a bid of " + Biddata.bid_amount,
                            user_id: authdata.id,
                            auction_id: Biddata.auction_id,
                            type: "seller"
                        };
                        await this.SendFcmNotification(Auction_data.user_id, seller_msg);
                        await Notification_1.default.create({
                            user_id: Auction_data.user_id,
                            notification: seller_msg.body,
                        });
                        let buyer_msg = {
                            title: "Zunkie Auto",
                            body: "You have successfully added a bid of " + Biddata.bid_amount,
                            user_id: authdata.id,
                            auction_id: Biddata.auction_id,
                            type: "buyer"
                        };
                        await this.SendFcmNotification(authdata.id, buyer_msg);
                        await Notification_1.default.create({
                            user_id: authdata.id,
                            notification: buyer_msg.body,
                        });
                        let response_data = {
                            status: true,
                            data: [],
                            message: "successfully pre bid on auction",
                        };
                        return response.json(response_data);
                    }
                    else {
                        let response_data = {
                            status: false,
                            errors: [{
                                    "message": "The pre bid amount greater than last bid",
                                }],
                        };
                        return response.json(response_data);
                    }
                }
                else {
                    await AuctionBid_1.default.create(Biddata);
                    let seller_msg = {
                        title: "Zunkie Auto",
                        body: User_data.first_name + " " + User_data.last_name + " has made a bid of " + Biddata.bid_amount,
                        user_id: authdata.id,
                        auction_id: Biddata.auction_id,
                        type: "seller"
                    };
                    await this.SendFcmNotification(Auction_data.user_id, seller_msg);
                    await Notification_1.default.create({
                        user_id: Auction_data.user_id,
                        notification: seller_msg.body,
                    });
                    let buyer_msg = {
                        title: "Zunkie Auto",
                        body: "You have successfully added a bid of " + Biddata.bid_amount,
                        user_id: authdata.id,
                        auction_id: Biddata.auction_id,
                        type: "buyer"
                    };
                    await this.SendFcmNotification(authdata.id, buyer_msg);
                    await Notification_1.default.create({
                        user_id: authdata.id,
                        notification: buyer_msg.body,
                    });
                    let response_data = {
                        status: true,
                        data: [],
                        message: "successfully pre bid on auction",
                    };
                    return response.json(response_data);
                }
            }
            else if (Biddata.type == 'direct_buy') {
                Biddata.bid_winner = "1";
                Biddata.status = "2";
                await AuctionBid_1.default.create(Biddata);
                await Auction_1.default.query().where('id', Biddata.auction_id).update({ status: '3' });
                let seller_msg = {
                    title: "Zunkie Auto",
                    body: "Your auction  has been purchased by" + User_data.first_name + " " + User_data.last_name,
                    user_id: authdata.id,
                    auction_id: Biddata.auction_id,
                    type: "seller"
                };
                await this.SendFcmNotification(Auction_data.user_id, seller_msg);
                await Notification_1.default.create({
                    user_id: Auction_data.user_id,
                    notification: seller_msg.body,
                });
                let buyer_msg = {
                    title: "Zunkie Auto",
                    body: "You have successfully purchased auction ",
                    user_id: authdata.id,
                    auction_id: Biddata.auction_id,
                    type: "seller"
                };
                await this.SendFcmNotification(authdata.id, buyer_msg);
                await Notification_1.default.create({
                    user_id: authdata.id,
                    notification: buyer_msg.body,
                });
                let response_data = {
                    status: true,
                    data: [],
                    message: "successfully buy request sent on auction",
                };
                return response.json(response_data);
            }
            else {
                await AuctionBid_1.default.create(Biddata);
                let seller_msg = {
                    title: "Zunkie Auto",
                    body: User_data.first_name + " " + User_data.last_name + " has made a bid of " + Biddata.bid_amount,
                    user_id: authdata.id,
                    auction_id: Biddata.auction_id,
                    type: "seller"
                };
                await this.SendFcmNotification(Auction_data.user_id, seller_msg);
                await Notification_1.default.create({
                    user_id: Auction_data.user_id,
                    notification: seller_msg.body,
                });
                let buyer_msg = {
                    title: "Zunkie Auto",
                    body: "You have successfully added a bid of " + Biddata.bid_amount,
                    user_id: authdata.id,
                    auction_id: Biddata.auction_id,
                    type: "buyer"
                };
                await this.SendFcmNotification(authdata.id, buyer_msg);
                await Notification_1.default.create({
                    user_id: authdata.id,
                    notification: buyer_msg.body,
                });
                let response_data = {
                    status: true,
                    data: [],
                    message: "successfully bid on auction",
                };
                return response.json(response_data);
            }
        }
        else {
            let response_data = {
                status: false,
                errors: [{
                        "message": "The bid amount is less than minimum bid amount",
                    }],
            };
            return response.json(response_data);
        }
    }
    async Reject_bid({ request, response }) {
        await AuctionBid_1.default.query().where('id', request.input("bid_id")).update({
            status: "0"
        });
        let auctionbid = await AuctionBid_1.default.query().where('id', request.input("bid_id")).first();
        let buyer_msg = {
            title: "Zunkie Auto",
            body: "You bid rejected",
            user_id: auctionbid?.user_id,
            auction_id: auctionbid?.auction_id,
            type: "buyer"
        };
        await this.SendFcmNotification(auctionbid?.user_id, buyer_msg);
        await Notification_1.default.create({
            user_id: auctionbid?.user_id,
            notification: buyer_msg.body,
        });
        let response_data = {
            status: false,
            errors: [{
                    "message": "successfully bid rejected",
                }],
        };
        return response.json(response_data);
    }
    async My_bid_list({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let language = request.languages();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data')
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').preload('userdata');
        })
            .whereHas('bid_data', (profileQuery) => {
            profileQuery.where('user_id', authdata.id);
        })
            .orderBy('bid_end', 'desc');
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "my auction bid list",
        };
        return response.json(response_data);
    }
    async Bid_details({ request, auth, response, params }) {
        let authdata = await auth.use('api').authenticate();
        let language = request.languages();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data')
            .preload('maxPreBid', (profileQuery) => {
            profileQuery
                .where('user_id', authdata.id)
                .orderBy('id', 'desc')
                .preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .whereHas('bid_data', (profileQuery) => {
            profileQuery.where('user_id', authdata.id);
        })
            .where('id', params.id)
            .first();
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "bid details list",
        };
        return response.json(response_data);
    }
    async Check_winner({ auth, response, params }) {
        let authdata = await auth.use('api').authenticate();
        let Bid_user = await AuctionBid_1.default.query().where('bid_winner', '1').where('auction_id', params.auction_id).where('user_id', authdata.id).first();
        if (Bid_user) {
            let my_auction_list = await Auction_1.default.query()
                .preload('seller')
                .where('id', params.auction_id)
                .first();
            let response_data = {
                status: true,
                data: my_auction_list?.seller,
                message: "bid details list",
            };
            return response.json(response_data);
        }
        else {
            let response_data = {
                status: true,
                data: [],
                message: "seller details list",
            };
            return response.json(response_data);
        }
    }
    async Bid_mobile_details({ request, auth, response, params }) {
        let authdata = await auth.use('api').authenticate();
        let language = request.languages();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data')
            .preload('maxPreBid', (profileQuery) => {
            profileQuery
                .where('user_id', authdata.id)
                .orderBy('id', 'desc')
                .preload('userdata', (userQuery) => {
                userQuery.select('first_name', 'last_name');
            });
        })
            .whereHas('bid_data', (profileQuery) => {
            profileQuery.where('user_id', authdata.id);
        })
            .preload('seller')
            .preload('winner_data', (profileQuery) => {
            profileQuery.where('bid_winner', '1').preload('userdata');
        })
            .where('id', params.id)
            .first();
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "bid details list",
        };
        return response.json(response_data);
    }
    async My_auction_bid_list({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let language = request.languages();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data', (profileQuery) => {
            profileQuery.preload('userdata');
        })
            .has('bid_data')
            .where('user_id', authdata.id)
            .orderBy('bid_end', 'desc');
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "bid details list",
        };
        return response.json(response_data);
    }
    async Make_auction_winner({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let auction_id = request.input('auction_id');
        let bid_id = request.input('bid_id');
        let auction_exits = await Auction_1.default.query().where('id', auction_id).where('status', "2").where('user_id', authdata.id).first();
        if (auction_exits) {
            await AuctionBid_1.default.query().where('id', bid_id).update({
                bid_winner: 1,
                status: "2",
            });
            await Auction_1.default.query().where('id', auction_id).update({
                status: "3",
            });
            let Bid_user = await AuctionBid_1.default.query().where('id', bid_id).first();
            let total_amount = Bid_user?.bid_amount;
            let commission_total_amount = ((5 / 100) * total_amount).toFixed(2);
            let commission = parseFloat(commission_total_amount);
            await AdminCommission_1.default.create({
                auction_id: auction_id,
                user_id: Bid_user?.user_id,
                bid_amount: Bid_user?.bid_amount,
                commission_amount: commission
            });
            let buyer_msg = {
                title: "Zunkie Auto",
                body: "You have successfully win bid",
                user_id: Bid_user?.user_id,
                auction_id: bid_id,
                type: "buyer"
            };
            await this.SendFcmNotification(Bid_user?.user_id, buyer_msg);
            await Notification_1.default.create({
                user_id: Bid_user?.user_id,
                notification: buyer_msg.body,
            });
            let response_data = {
                status: true,
                data: [],
                message: "auction winner completed",
            };
            return response.json(response_data);
        }
        else {
            let response_data = {
                status: false,
                data: [],
                message: "Auction not active or already winner",
            };
            return response.json(response_data);
        }
    }
    async Add_wish_list({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        await request.validate({
            schema: Validator_1.schema.create({
                auction_id: Validator_1.schema.number([
                    Validator_1.rules.unique({
                        table: 'wish_lists', column: 'auction_id', where: {
                            user_id: authdata.id,
                        },
                    })
                ]),
            }),
            messages: {
                'auction_id.required': 'The {{ field }} is required',
                'auction_id.unique': 'The auction  is already in wish list',
            },
            reporter: ApiReporters_1.ApiReporters,
        });
        let Wishlist_data = request.all();
        Wishlist_data.user_id = authdata.id;
        await WishList_1.default.create(Wishlist_data);
        let response_data = {
            status: true,
            data: [],
            message: "successfully add auction in wishlist",
        };
        return response.json(response_data);
    }
    async My_wish_list_delete({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let remove_data = request.all();
        await WishList_1.default.query().where('auction_id', remove_data.auction_id).where('user_id', authdata.id).delete();
        let response_data = {
            status: true,
            data: [],
            message: "successfully remove wish list",
        };
        return response.json(response_data);
    }
    async My_wish_list({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let language = request.languages();
        let my_auction_list = await Auction_1.default.query()
            .preload('make_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('model_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('auction_image', (profileQuery) => {
            profileQuery.where('type', 'image');
        })
            .preload('auction_video', (profileQuery) => {
            profileQuery.where('type', 'video');
        })
            .preload('damage_filter_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('secondary_damage_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('drive_line_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('body_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('fule_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('transmission_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('color_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('catalytic_convertor_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('used_type_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('title_status_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('clean_title_name', (profileQuery) => {
            profileQuery.where('language', language[0]).select('name');
        })
            .preload('bid_data')
            .whereHas('wish_list', (profileQuery) => {
            profileQuery.where('user_id', authdata.id);
        })
            .orderBy('bid_end', 'desc');
        let response_data = {
            status: true,
            data: my_auction_list,
            message: "my wish list",
        };
        return response.json(response_data);
    }
    async Save_search({ request, auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let Save_data = {};
        let input_data = request.all();
        Save_data.user_id = authdata.id;
        Save_data.search_name = input_data.search_name;
        delete input_data.search_name;
        Save_data.search = JSON.stringify(input_data);
        await SearchSave_1.default.create(Save_data);
        let response_data = {
            status: true,
            data: [],
            message: "successfully save search",
        };
        return response.json(response_data);
    }
    async Update_save_search({ request, response }) {
        let Save_data = {};
        let input_data = request.all();
        let search_id = input_data.update_id;
        Save_data.search_name = input_data.search_name;
        delete input_data.update_id;
        delete input_data.search_name;
        Save_data.search = JSON.stringify(input_data);
        await SearchSave_1.default.query().where('id', search_id).update(Save_data);
        let response_data = {
            status: true,
            data: [],
            message: "successfully update search",
        };
        return response.json(response_data);
    }
    async Get_search({ auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let save_list = await SearchSave_1.default.query().where('user_id', authdata.id);
        let response_data = {
            status: true,
            data: save_list,
            message: "Search list.",
        };
        return response.json(response_data);
    }
    async Delete_search({ request, response }) {
        let remove_data = request.all();
        await SearchSave_1.default.query().where('id', remove_data.id).delete();
        let response_data = {
            status: true,
            data: [],
            message: "successfully remove search",
        };
        return response.json(response_data);
    }
    async Notification_list({ auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let notification_list = await Notification_1.default.query().where('user_id', authdata.id).where('status', '1');
        let response_data = {
            status: true,
            data: notification_list,
            message: "notification list",
        };
        return response.json(response_data);
    }
    async Notification_list_all({ auth, response }) {
        let authdata = await auth.use('api').authenticate();
        let notification_list = await Notification_1.default.query().where('user_id', authdata.id);
        let response_data = {
            status: true,
            data: notification_list,
            message: "notification list",
        };
        return response.json(response_data);
    }
    async Notification_read({ auth, response, params }) {
        let authdata = await auth.use('api').authenticate();
        await Notification_1.default.query().where('user_id', authdata.id).where('id', params.id).update({
            status: "2"
        });
        let response_data = {
            status: true,
            data: [],
            message: "notification update",
        };
        return response.json(response_data);
    }
    async Notification_deleted({ auth, response, params }) {
        let authdata = await auth.use('api').authenticate();
        await Notification_1.default.query().where('user_id', authdata.id).where('id', params.id).delete();
        let response_data = {
            status: true,
            data: [],
            message: "notification deleted",
        };
        return response.json(response_data);
    }
    async SendFcmNotification(user_id, data_value) {
        let Userdata = await User_1.default.query().where('id', user_id).first();
        let serverKey = "AAAAo9mRI28:APA91bHFt9XSLrV5YzGUoqbEb_b8e3r_Z-JwOyq3FGQzFmrYAm52nMUblCD-vmupBc028yHSSLjtR-FIwkwZo7KdW0hjtGR2VeAaubXbNuarCynDdyPXEH49JOH-u4Ko_2yNUnE3bgYF";
        let fcm = new FCM(serverKey);
        let message = {
            to: Userdata?.device_token,
            collapse_key: '',
            priority: 'high',
            content_available: true,
            notification: data_value,
            data: data_value,
        };
        return await fcm.send(message, function (err, response) {
            if (err) {
                return true;
            }
            else {
                console.log("Successfully sent with response:ios= ", response);
                return true;
            }
        });
    }
}
exports.default = UsersController;
//# sourceMappingURL=UsersController.js.map