"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class Users extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'users';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.string('email', 255).notNullable().unique();
            table.string('password', 255).notNullable();
            table.string('mobile_number', 255).nullable();
            table.string('first_name', 255).nullable();
            table.string('last_name', 255).nullable();
            table.string('address', 255).nullable();
            table.string('street', 255).nullable();
            table.string('city', 255).nullable();
            table.string('state', 255).nullable();
            table.string('country', 255).nullable();
            table.string('remember_me_token').nullable();
            table.string('document_type', 255).nullable();
            table.string('doc_issue_state', 255).nullable();
            table.date('issue_date').nullable();
            table.date('expire_date').nullable();
            table.string('id_number').nullable();
            table.string('otp', 255).nullable();
            table.enum('status', ['0', '1', '2', '3']).defaultTo('0');
            table.enum('type', ['individual', 'business']).defaultTo('individual');
            table.string('device_token', 800).nullable();
            table.enum('device_type', ['android', 'ios']).defaultTo('android');
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = Users;
//# sourceMappingURL=1635877194217_users.js.map