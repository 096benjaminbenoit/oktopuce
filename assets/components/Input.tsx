import { forwardRef, useId } from 'react';
import Form from 'react-bootstrap/Form';

import {UseFormRegisterReturn} from "react-hook-form";

type InputProps = {
  name?: string,
  value?: string,
  placeholder?: string,
  label: string,
} & UseFormRegisterReturn<string>;

const Input = forwardRef(function ({label, ...inputProps}: InputProps, ref) {
  const inputId = useId();
  return (
    <>
      <Form.Group className="mb-3">
        <Form.Label id={inputId}>
          {label}
        </Form.Label>
        <Form.Control {...inputProps}
          aria-label={label}
          aria-describedby={inputId}
          ref={ref as any}
        />
      </Form.Group>
    </>
  );
});

export default Input;