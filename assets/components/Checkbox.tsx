import React from 'react';
import Form from 'react-bootstrap/Form';
import InputGroup from 'react-bootstrap/InputGroup';

type CheckboxProps = {
  name?: string,
  value?: string, 
}

function Checkbox({ props, name, value }) {
  return (
    <>
      <InputGroup className="mb-3">
        <InputGroup.Checkbox aria-label="Checkbox for following text input" />
        <Form.Control {...props} aria-label="Text input with checkbox" />
      </InputGroup>
    </>
  );
}

export default Checkbox;