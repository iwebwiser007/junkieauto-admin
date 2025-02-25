"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class Languages extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'languages';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.string('name').nullable().comment('Languages full name');
            table.string('short_name').nullable().comment('Short languages name');
            table.timestamps(true);
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = Languages;
//# sourceMappingURL=1636993357074_languages.js.map