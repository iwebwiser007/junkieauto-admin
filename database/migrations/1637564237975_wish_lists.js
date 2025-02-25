"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class WishLists extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'wish_lists';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('auction_id').unsigned().references('auctions.id');
            table.integer('user_id').unsigned().references('users.id');
            table.enu('status', ['1', '2']).defaultTo(1);
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = WishLists;
//# sourceMappingURL=1637564237975_wish_lists.js.map