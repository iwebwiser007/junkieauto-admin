"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class AuctionMedias extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'auction_medias';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('auction_id').unsigned().references('auctions.id');
            table.string('media_url').nullable();
            table.enu('type', ['image', 'video']).defaultTo('image');
            table.enu('status', ['0', '1', '2']).defaultTo(1);
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = AuctionMedias;
//# sourceMappingURL=1636718870264_auction_medias.js.map