"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class Banners extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'banners';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.string('title').nullable();
            table.string('description').nullable();
            table.string('image_path').nullable();
            table.enu('status', ['0', '1']).defaultTo('1').comment('1=active,0= deactive');
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = Banners;
//# sourceMappingURL=1637143370825_banners.js.map