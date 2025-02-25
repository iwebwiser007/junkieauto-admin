"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const luxon_1 = require("luxon");
const Orm_1 = global[Symbol.for('ioc.use')]("Adonis/Lucid/Orm");
const Hash_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Core/Hash"));
const DocumentExtraField_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/DocumentExtraField"));
class User extends Orm_1.BaseModel {
    static boot() {
        super.boot();
    }
    static get hidden() {
        return ['password'];
    }
    static async hashPassword(user) {
        if (user.$dirty.password) {
            user.password = await Hash_1.default.make(user.password);
        }
    }
}
__decorate([
    Orm_1.column({ isPrimary: true }),
    __metadata("design:type", Number)
], User.prototype, "id", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "email", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "password", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "mobile_number", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "profile_url", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "first_name", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "last_name", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "address", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "street", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "city", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "state", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "country", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "status", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "otp", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "document_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "doc_issue_state", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Date)
], User.prototype, "issue_date", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Date)
], User.prototype, "expire_date", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "id_number", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "forgot_token", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "device_token", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "device_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], User.prototype, "cancel_reason", void 0);
__decorate([
    Orm_1.column.dateTime({ autoCreate: true }),
    __metadata("design:type", luxon_1.DateTime)
], User.prototype, "createdAt", void 0);
__decorate([
    Orm_1.column.dateTime({ autoCreate: true, autoUpdate: true }),
    __metadata("design:type", luxon_1.DateTime)
], User.prototype, "updatedAt", void 0);
__decorate([
    Orm_1.hasOne(() => DocumentExtraField_1.default, {
        foreignKey: 'user_id',
    }),
    __metadata("design:type", Object)
], User.prototype, "document_data", void 0);
__decorate([
    Orm_1.beforeSave(),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [User]),
    __metadata("design:returntype", Promise)
], User, "hashPassword", null);
exports.default = User;
//# sourceMappingURL=User.js.map