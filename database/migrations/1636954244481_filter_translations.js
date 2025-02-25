"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class FilterTranslations extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'filter_translations';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('filter_id').unsigned().references('id').inTable('filter_lists');
            table.string('name').nullable();
            table.string('language').defaultTo('en');
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = FilterTranslations;
//# sourceMappingURL=1636954244481_filter_translations.js.map