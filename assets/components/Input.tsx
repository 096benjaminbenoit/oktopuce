import { useId } from 'react';
import Form from 'react-bootstrap/Form';
import InputGroup from 'react-bootstrap/InputGroup';

import {UseFormRegisterReturn} from "react-hook-form";

type InputProps = {
  name?: string,
  value?: string,
  placeholder?: string,
  label: string,
} & UseFormRegisterReturn<string>;

function Input({label, ...inputProps}: InputProps) {
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
        />
      </Form.Group>
    </>
  );
}

export default Input;