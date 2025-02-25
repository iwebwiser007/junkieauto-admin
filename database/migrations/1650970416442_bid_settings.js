"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class BidSettings extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'bid_settings';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.float('commission').defaultTo(0);
            table.enu('status', ['0', '1', '2']).defaultTo(0);
            table.timestamp('created_at', { useTz: true });
            table.timestamp('updated_at', { useTz: true });
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = BidSettings;
//# sourceMappingURL=1650970416442_bid_settings.js.map