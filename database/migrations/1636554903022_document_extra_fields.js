"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class DocumentExtraFields extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'document_extra_fields';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('user_id').unsigned().references('users.id');
            table.string('license_number').nullable();
            table.string('insurance_company').nullable();
            table.string('inventory_coverage_amount').nullable();
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = DocumentExtraFields;
//# sourceMappingURL=1636554903022_document_extra_fields.js.map