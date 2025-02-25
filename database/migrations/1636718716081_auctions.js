"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const Schema_1 = __importDefault(global[Symbol.for('ioc.use')]("Adonis/Lucid/Schema"));
class Auctions extends Schema_1.default {
    constructor() {
        super(...arguments);
        this.tableName = 'auctions';
    }
    async up() {
        this.schema.createTable(this.tableName, (table) => {
            table.increments('id');
            table.integer('user_id').unsigned().references('users.id');
            table.string('address').nullable();
            table.string('city').nullable();
            table.string('state').nullable();
            table.string('country').nullable();
            table.float('lat', 11, 2).defaultTo(0);
            table.float('lng', 11, 2).defaultTo(0);
            table.float('bid_price', 11, 2).defaultTo(0);
            table.float('sale_price', 11, 2).defaultTo(0);
            table.float('bid_closed_price', 11, 2).defaultTo(0);
            table.date('bid_start').nullable();
            table.date('bid_end').nullable();
            table.integer('make').nullable();
            table.integer('model').nullable();
            table.integer('year').nullable();
            table.string('mileage').nullable();
            table.string('damage_type').nullable();
            table.string('secondary_damage_type').nullable();
            table.string('vin').nullable();
            table.string('drive_line_type').nullable();
            table.string('body_type').nullable();
            table.string('fule_type').nullable();
            table.string('engine').nullable();
            table.string('transmission').nullable();
            table.string('color').nullable();
            table.text('details').nullable();
            table.enu('status', ['0', '1', '2', '3', '4']).defaultTo(1);
            table.enu('used_type', ['used', 'new', 'junk']).defaultTo('used');
            table.timestamps();
        });
    }
    async down() {
        this.schema.dropTable(this.tableName);
    }
}
exports.default = Auctions;
//# sourceMappingURL=1636718716081_auctions.js.map