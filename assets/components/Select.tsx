import {UseFormRegisterReturn} from "react-hook-form";


type Option = {};
type SelectProp = {
    options: Option[];
} & UseFormRegisterReturn<"">

function Select({
    options
}: SelectProp) {

}

import React from "react";
import { useForm, SubmitHandler } from "react-hook-form";

type Person = {
  firstName: string;
  lastName: string;
  email: string;
}

type FormValues = Person & {
  site: {
    name: string;
    address: string;
  }
  contacts: Person[];
};

declare const n: number;

export default function App() {
  const { register, handleSubmit } = useForm<FormValues>();
  const onSubmit: SubmitHandler<FormValues> = data => console.log(data);

  return (
    <form onSubmit={handleSubmit(onSubmit)}>
      <input {...register("firstName")} />
      <input {...register("lastName")} />

      <input type="email" {...register(`contacts.${n}.firstName`)} />

      <input type="submit" />
    </form>
  )
};
