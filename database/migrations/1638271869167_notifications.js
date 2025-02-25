"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class Notifications extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'notifications';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('user_id').unsigned().references('users.id');
            table.string('notification').nullable();
            table.enu('status', ['0', '1', '2']).defaultTo(1);
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = Notifications;
//# sourceMappingURL=1638271869167_notifications.js.map