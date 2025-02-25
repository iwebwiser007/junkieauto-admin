"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class AdminCommissions extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'admin_commissions';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('auction_id').unsigned().references('auctions.id');
            table.integer('user_id').unsigned().references('users.id');
            table.float('bid_amount', 10, 2).defaultTo(0);
            table.float('commission_amount', 10, 2).defaultTo(0);
            table.enu('status', ['1', '2']).defaultTo(1);
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = AdminCommissions;
//# sourceMappingURL=1637394745530_admin_commissions.js.map