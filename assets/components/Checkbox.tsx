import React, { forwardRef } from 'react';
import Form from 'react-bootstrap/Form';

import { UseFormRegisterReturn } from "react-hook-form";

type CheckboxProps = {
  name?: string,
  value?: string,
  label: string,
} & UseFormRegisterReturn<string>;


const Checkbox = forwardRef<HTMLInputElement>(function ({ ...rest }: CheckboxProps, ref) {
  return (
    <Form.Check type="checkbox" {...rest} ref={ref} />
  );
})


export default Checkbox;