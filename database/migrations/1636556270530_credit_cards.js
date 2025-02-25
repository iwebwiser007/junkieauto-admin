"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class CreditCards extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'credit_cards';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('user_id').unsigned().references('id').inTable('users');
            table.string('name').nullable();
            table.string('card_number').nullable();
            table.string('expird_date').nullable();
            table.string('cvc').nullable();
            table.timestamps(true);
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = CreditCards;
//# sourceMappingURL=1636556270530_credit_cards.js.map