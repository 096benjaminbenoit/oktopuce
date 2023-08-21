import React from 'react';
import Form from 'react-bootstrap/Form';

type CheckboxProps = {
  name?: string,
  value?: string,
  label?: string,
}

function Checkbox({ name, value, label }: CheckboxProps) {
  return (
    <>
  <Form.Check type="checkbox" label={label} value={value} name={name} />
    </>
  );
}

export default Checkbox;