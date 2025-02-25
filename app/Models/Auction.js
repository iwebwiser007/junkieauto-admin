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
const AuctionMedia_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/AuctionMedia"));
const FilterTranslation_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/FilterTranslation"));
const CategoryTranslation_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/CategoryTranslation"));
const AuctionBid_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/AuctionBid"));
const User_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/User"));
const WishList_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/WishList"));
class Auction extends Orm_1.BaseModel {
}
__decorate([
    Orm_1.column({ isPrimary: true }),
    __metadata("design:type", Number)
], Auction.prototype, "id", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "user_id", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "address", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "city", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "state", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "country", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "lat", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "lng", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "bid_price", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "sale_price", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "bid_closed_price", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Date)
], Auction.prototype, "bid_start", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Date)
], Auction.prototype, "bid_end", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "make", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "model", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "year", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "mileage", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "damage_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "secondary_damage_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "vin", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "drive_line_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "body_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "fuel_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "catalytic_convertor", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "title_status", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "clean_title", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "engine", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "transmission", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "color", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "details", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "latest_offer", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "status", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], Auction.prototype, "used_type", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "cancel_reason", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], Auction.prototype, "cancel_by", void 0);
__decorate([
    Orm_1.column.dateTime({ autoCreate: true }),
    __metadata("design:type", luxon_1.DateTime)
], Auction.prototype, "createdAt", void 0);
__decorate([
    Orm_1.column.dateTime({ autoCreate: true, autoUpdate: true }),
    __metadata("design:type", luxon_1.DateTime)
], Auction.prototype, "updatedAt", void 0);
__decorate([
    Orm_1.hasMany(() => AuctionMedia_1.default, {
        foreignKey: 'auction_id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "auction_image", void 0);
__decorate([
    Orm_1.hasMany(() => AuctionMedia_1.default, {
        foreignKey: 'auction_id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "auction_video", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'damage_type',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "damage_filter_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'secondary_damage_type',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "secondary_damage_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'drive_line_type',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "drive_line_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'body_type',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "body_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'fuel_type',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "fule_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'transmission',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "transmission_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'color',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "color_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'used_type',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "used_type_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'catalytic_convertor',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "catalytic_convertor_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'title_status',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "title_status_name", void 0);
__decorate([
    Orm_1.hasMany(() => FilterTranslation_1.default, {
        foreignKey: 'id',
        localKey: 'clean_title',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "clean_title_name", void 0);
__decorate([
    Orm_1.hasMany(() => CategoryTranslation_1.default, {
        foreignKey: 'caregory_id',
        localKey: 'make',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "make_name", void 0);
__decorate([
    Orm_1.hasMany(() => CategoryTranslation_1.default, {
        foreignKey: 'caregory_id',
        localKey: 'model',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "model_name", void 0);
__decorate([
    Orm_1.hasMany(() => AuctionBid_1.default, {
        foreignKey: 'auction_id',
        localKey: 'id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "bid_data", void 0);
__decorate([
    Orm_1.hasMany(() => AuctionBid_1.default, {
        onQuery(query) {
            query.where('type', "pre_bid");
        },
        foreignKey: 'auction_id',
        localKey: 'id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "maxPreBid", void 0);
__decorate([
    Orm_1.hasOne(() => AuctionBid_1.default, {
        foreignKey: 'auction_id',
        localKey: 'id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "winner_data", void 0);
__decorate([
    Orm_1.hasMany(() => AuctionBid_1.default, {
        foreignKey: 'auction_id',
        localKey: 'id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "bid_data_info", void 0);
__decorate([
    Orm_1.hasMany(() => Auction, {
        foreignKey: 'id',
        localKey: 'id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "distance_data", void 0);
__decorate([
    Orm_1.hasMany(() => User_1.default, {
        foreignKey: 'id',
        localKey: 'user_id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "seller", void 0);
__decorate([
    Orm_1.hasMany(() => WishList_1.default, {
        foreignKey: 'auction_id',
        localKey: 'id',
    }),
    __metadata("design:type", Object)
], Auction.prototype, "wish_list", void 0);
exports.default = Auction;
//# sourceMappingURL=Auction.js.map