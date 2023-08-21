import React from 'react';
import Form from 'react-bootstrap/Form';

type CheckboxProps = {
  name?: string,
  value?: string,
  label?: string,
}

function Checkbox({ ...rest }: CheckboxProps) {
  return (
    <>
  <Form.Check type="checkbox" {...rest} />
    </>
  );
}


export default Checkbox;