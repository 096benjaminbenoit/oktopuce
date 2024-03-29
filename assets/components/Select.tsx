import React from 'react';
import Form from 'react-bootstrap/Form';
import { UseFormRegisterReturn } from 'react-hook-form';

type Option = {
  label: string,
  value: string,
  disabled?: boolean,
}
type SelectProps = {
  options: Option[]
  onChange?: (event: React.ChangeEvent) => void;
  defaultValue?: string,
  value?: string,
  multiple?: boolean,
} & UseFormRegisterReturn<string>;

const Select = React.forwardRef(function ({ options, ...selectProps }: SelectProps, ref: React.Ref<HTMLSelectElement>) {
  return (
    <Form.Select aria-label="Select" {...selectProps} ref={ref}>
      {options.map((option, index) => (
        <option key={index} value={option.value} disabled={option.disabled}>
          {option.label}
        </option>
      ))}
    </Form.Select>
  );
});

export default Select;
