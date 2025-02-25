"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class Categories extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'categories';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.string('name').nullable();
            table.integer('is_parent').defaultTo(0);
            table.enum('status', ['0', '1']).defaultTo(1);
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = Categories;
//# sourceMappingURL=1636556439613_categories.js.map