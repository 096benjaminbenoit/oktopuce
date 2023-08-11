import React from 'react';
import Form from 'react-bootstrap/Form';

function Select({ options, defaultValue, onChange }) {
  return (
    <Form.Select aria-label="Select" onChange={onChange} defaultValue={defaultValue}>
      <option>{defaultValue}</option>
      {options.map((option, index) => (
        <option key={index} value={option.value}>
          {option.label}
        </option>
      ))}
    </Form.Select>
  );
}

export default Select;
