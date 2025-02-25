"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class FilterLables extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'filter_lables';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('filter_id').unsigned().references('id').inTable('filter_lists');
            table.string('label_name').nullable();
            table.string('language').defaultTo('en');
            table.timestamps(true);
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = FilterLables;
//# sourceMappingURL=1637060037006_filter_lables.js.map