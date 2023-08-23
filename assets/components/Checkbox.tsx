import React from 'react';
import Form from 'react-bootstrap/Form';

import {UseFormRegisterReturn} from "react-hook-form";

type CheckboxProps = {
  name?: string,
  value?: string,
  label: string,
} & UseFormRegisterReturn<"">;


function Checkbox({ ...rest }: CheckboxProps) {
  return (
    <>
  <Form.Check type="checkbox" {...rest} />
    </>
  );
}


export default Checkbox;