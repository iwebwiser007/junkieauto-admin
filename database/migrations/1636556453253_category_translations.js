"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class CategoryTranslations extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'category_translations';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('caregory_id').unsigned().references('id').inTable('categories');
            table.string('name').nullable();
            table.string('language').defaultTo('en');
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = CategoryTranslations;
//# sourceMappingURL=1636556453253_category_translations.js.map