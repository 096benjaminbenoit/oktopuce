import React from 'react';
import Form from 'react-bootstrap/Form';

type Option = {
  label: string,
  value: string,
}
type SelectProps = {
  options: Option[]
  onChange?: (event: React.ChangeEvent) => void;
  defaultValue?: string,
  value?: string
}

function Select({ options, ...selectProps }: SelectProps) {
  return (
    <Form.Select aria-label="Select" {...selectProps}>
      {options.map((option, index) => (
        <option key={index} value={option.value}>
          {option.label}
        </option>
      ))}
    </Form.Select>
  );
}

export default Select;
