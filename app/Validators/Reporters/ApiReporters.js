"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.ApiReporters = void 0;
const Validator_1 = global[Symbol.for('ioc.use')]("Adonis/Core/Validator");
class ApiReporters {
    constructor(messages, bail) {
        this.messages = messages;
        this.bail = bail;
        this.hasErrors = false;
        this.errors = [];
    }
    report(pointer, rule, message, arrayExpressionPointer, args) {
        this.hasErrors = true;
        const errorMessage = this.messages.get(pointer, rule, message, arrayExpressionPointer, args);
        this.errors.push({ message: errorMessage, field: pointer });
        if (this.bail) {
            throw this.toError();
        }
    }
    toError() {
        throw new Validator_1.ValidationException(false, this.toJSON());
    }
    toJSON() {
        return {
            success: false,
            errors: this.errors,
        };
    }
}
exports.ApiReporters = ApiReporters;
//# sourceMappingURL=ApiReporters.js.map