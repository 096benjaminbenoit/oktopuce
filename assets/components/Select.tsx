import React from 'react';
import Form from 'react-bootstrap/Form';
import { UseFormRegisterReturn } from 'react-hook-form';

type Option = {
  label: string,
  value: string,
}
type SelectProps = {
  options: Option[]
  onChange?: (event: React.ChangeEvent) => void;
  defaultValue?: string,
} & UseFormRegisterReturn<string>;

function Select({ options, defaultValue, onChange, ...rest }: SelectProps) {
  return (
    <Form.Select aria-label="Select" onChange={onChange} defaultValue={defaultValue} {...rest}>
      {options.map((option, index) => (
        <option key={index} value={option.value}>
          {option.label}
        </option>
      ))}
    </Form.Select>
  );
}

export default Select;
