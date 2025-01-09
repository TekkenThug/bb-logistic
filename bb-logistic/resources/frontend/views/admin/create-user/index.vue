<script lang="ts" setup>
import { useForm } from 'vee-validate';
import { createUserSchema } from '@/data/forms';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import { Button } from '@/components/ui/button';
import { FormField, FormItem, FormLabel, FormControl, FormMessage, FormDescription } from '@/components/ui/form';

const form = useForm({
  validationSchema: createUserSchema,
});

const createNewUser = form.handleSubmit((values) => {
  console.log(values);
});
</script>

<template>
  <section class="w-1/3">
    <h2>Создание учетной записи</h2>

    <form
      class="space-y-8"
      @submit="createNewUser"
    >
      <FormField
        v-slot="{ componentField }"
        name="role"
      >
        <FormItem>
          <FormLabel>Роль</FormLabel>

          <FormControl>
            <RadioGroup
              v-bind="componentField"
              default-value="admin"
              :orientation="'vertical'"
            >
              <div class="flex items-center space-x-2">
                <RadioGroupItem
                  id="r1"
                  value="admin"
                />
                <Label for="r1">Администратор</Label>
              </div>

              <div class="flex items-center space-x-2">
                <RadioGroupItem
                  id="r2"
                  value="client"
                />
                <Label for="r2">Клиент</Label>
              </div>

              <div class="flex items-center space-x-2">
                <RadioGroupItem
                  id="r3"
                  value="courier"
                />
                <Label for="r3">Курьер</Label>
              </div>
            </RadioGroup>
          </FormControl>
        </FormItem>
      </FormField>

      <FormField
        v-slot="{ componentField }"
        name="name"
      >
        <FormItem>
          <FormLabel>Имя</FormLabel>

          <FormControl>
            <Input v-bind="componentField" />
          </FormControl>

          <FormDescription>
            Имя может отражать как одно лицо, так и целую компанию (пример ООО "Рога и Копыта")
          </FormDescription>
        </FormItem>
      </FormField>

      <FormField
        v-slot="{ componentField }"
        name="email"
      >
        <FormItem>
          <FormLabel>Email</FormLabel>

          <FormControl>
            <Input v-bind="componentField" />
          </FormControl>

          <FormMessage />
        </FormItem>
      </FormField>

      <FormField
        v-slot="{ componentField }"
        name="password"
      >
        <FormItem>
          <FormLabel>Пароль</FormLabel>

          <FormControl>
            <Input
              v-bind="componentField"
              type="password"
            />
          </FormControl>

          <FormDescription>
            Пароль должен быть от 6 символов, содержать хотя бы одну цифру и один спецсимвол.
          </FormDescription>
        </FormItem>
      </FormField>

      <FormField
        v-slot="{ componentField }"
        name="repeatPassword"
      >
        <FormItem>
          <FormLabel>Повторите пароль</FormLabel>

          <FormControl>
            <Input
              v-bind="componentField"
              type="password"
            />
          </FormControl>

          <FormMessage />
        </FormItem>
      </FormField>

      <FormField
        v-if="form.values.role === 'client'"
        v-slot="{ componentField }"
        name="deliveryAddress"
      >
        <FormItem>
          <FormLabel>Адрес</FormLabel>

          <FormControl>
            <Input
              v-bind="componentField"
            />
          </FormControl>

          <FormDescription>
            Адрес, по которому будет совершаться забор посылок.
            Указывайте полный адрес, начиная с города, заканчивая квартирой.
          </FormDescription>

          <FormMessage />
        </FormItem>
      </FormField>

      <FormField
        v-if="form.values.role === 'courier'"
        v-slot="{ componentField }"
        name="phone"
      >
        <FormItem>
          <FormLabel>Номер телефона</FormLabel>

          <FormControl>
            <Input
              v-bind="componentField"
            />
          </FormControl>

          <FormMessage />
        </FormItem>
      </FormField>

      <Button>
        Создать учетную запись
      </Button>
    </form>
  </section>
</template>
