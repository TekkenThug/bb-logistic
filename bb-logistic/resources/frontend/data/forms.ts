import { toTypedSchema } from "@vee-validate/zod";
import * as z from 'zod';
import { RU_PHONENUMBER, PASSWORD } from "./regexp";

export const createUserSchema = toTypedSchema(z.object({
    name: z.string().min(2).max(50),
    email: z.string({ required_error: 'Поле обязательно' }).email('Неверный формат почты'),
    password: z.string({ required_error: 'Поле обязательно' }).regex(PASSWORD, 'Неверный формат пароля'),
    repeatPassword: z.string({ required_error: 'Поле обязательно' }),
    role: z.string().default('admin'),
    deliveryAddress: z.string().optional(),
    phone: z.string().regex(RU_PHONENUMBER, "Номер должен начинаться с +7 без скобок").optional(),
  }).refine((data) => data.password === data.repeatPassword, {
    message: 'Пароли не совпадают',
    path: ['repeatPassword']
  })
  .refine((data) => data.role !== 'client' || (data.role === 'client' && Boolean(data.deliveryAddress)), {
    message: 'Адрес пуст',
    path: ['deliveryAddress']
  }).refine((data) => data.role !== 'courier' || (data.role === 'courier' && Boolean(data.phone)), {
    message: 'Неверный формат телефона',
    path: ['phone']
  }))