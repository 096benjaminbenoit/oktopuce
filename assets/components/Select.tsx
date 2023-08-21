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
}

function Select({ options, defaultValue, onChange }: SelectProps) {
  return (
    <Form.Select aria-label="Select" onChange={onChange} defaultValue={defaultValue}>
      {options.map((option, index) => (
        <option key={index} value={option.value}>
          {option.label}
        </option>
      ))}
    </Form.Select>
  );
}

export default Select;
