"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class DocumentFiles extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'document_files';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('user_id').unsigned().references('users.id');
            table.integer('document_id').unsigned().references('document_extra_fields.id');
            table.string('document_url').nullable();
            table.enu('status', ['0', '1']).defaultTo(1);
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = DocumentFiles;
//# sourceMappingURL=1636555158115_document_files.js.map