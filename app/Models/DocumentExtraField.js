"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const luxon_1 = require("luxon");
const Orm_1 = global[Symbol.for('ioc.use')]("Adonis/Lucid/Orm");
const DocumentFile_1 = __importDefault(global[Symbol.for('ioc.use')]("App/Models/DocumentFile"));
class DocumentExtraField extends Orm_1.BaseModel {
}
__decorate([
    Orm_1.column({ isPrimary: true }),
    __metadata("design:type", Number)
], DocumentExtraField.prototype, "id", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", Number)
], DocumentExtraField.prototype, "user_id", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], DocumentExtraField.prototype, "license_number", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], DocumentExtraField.prototype, "insurance_company", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], DocumentExtraField.prototype, "inventory_coverage_amount", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], DocumentExtraField.prototype, "status", void 0);
__decorate([
    Orm_1.column(),
    __metadata("design:type", String)
], DocumentExtraField.prototype, "cancel_reason", void 0);
__decorate([
    Orm_1.column.dateTime({ autoCreate: true }),
    __metadata("design:type", luxon_1.DateTime)
], DocumentExtraField.prototype, "createdAt", void 0);
__decorate([
    Orm_1.column.dateTime({ autoCreate: true, autoUpdate: true }),
    __metadata("design:type", luxon_1.DateTime)
], DocumentExtraField.prototype, "updatedAt", void 0);
__decorate([
    Orm_1.hasMany(() => DocumentFile_1.default, {
        foreignKey: 'document_id',
    }),
    __metadata("design:type", Object)
], DocumentExtraField.prototype, "document_file", void 0);
exports.default = DocumentExtraField;
//# sourceMappingURL=DocumentExtraField.js.map