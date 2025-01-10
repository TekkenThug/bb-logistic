import { toTypedSchema } from "@vee-validate/zod";
import * as z from 'zod';
import { RU_PHONENUMBER, PASSWORD } from "./regexp";

export const createUserSchema = toTypedSchema(z.object({
    name: z.string().min(2).max(50),
    email: z.string({ required_error: 'Поле обязательно' }).email('Неверный формат почты'),
    password: z.string({ required_error: 'Поле обязательно' }).regex(PASSWORD, 'Неверный формат пароля'),
    confirm_password: z.string({ required_error: 'Поле обязательно' }),
    role: z.string().default('client'),
    address: z.string().optional(),
    phone_number: z.string().regex(RU_PHONENUMBER, "Номер должен начинаться с +7 без скобок").optional(),
  }).refine((data) => data.password === data.confirm_password, {
    message: 'Пароли не совпадают',
    path: ['confirm_password']
  })
  .refine((data) => data.role !== 'client' || (data.role === 'client' && Boolean(data.address)), {
    message: 'Адрес пуст',
    path: ['address']
  }).refine((data) => data.role !== 'courier' || (data.role === 'courier' && Boolean(data.phone_number)), {
    message: 'Неверный формат телефона',
    path: ['phone_number']
  }))