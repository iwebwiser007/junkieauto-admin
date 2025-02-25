"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class AuctionBids extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'auction_bids';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('auction_id').unsigned().references('auctions.id');
            table.integer('user_id').unsigned().references('users.id');
            table.integer('bid_winner').defaultTo(0);
            table.float('bid_amount', 10, 2).defaultTo(0);
            table.enu('type', ['bid', 'direct_buy', 'pre_bid']).defaultTo('bid');
            table.enu('status', ['0', '1', '2']).defaultTo(1).comment('1=active,0= deactive,2=winner');
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = AuctionBids;
//# sourceMappingURL=1637219098752_auction_bids.js.map