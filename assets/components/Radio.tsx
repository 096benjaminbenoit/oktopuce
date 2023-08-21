import React from 'react';
import Form from 'react-bootstrap/Form';

type Option = {
  label?: string,
  value?: string,
}
type RadioProps = {
  options: Option[],
  onChange?: (event: React.ChangeEvent) => void;
  defaultValue?: string,
  name?: string,
} 

function Radio({ options, defaultValue, name, onChange }: RadioProps) {
  return (
    <>
    <Form.Select aria-label="Radio" onChange={onChange} defaultValue={defaultValue}>
      {options.map((option, index) => (
        <Form.Check key={index} value={option.value} label={option.label} name={name}>
        </Form.Check>
      ))}
    </Form.Select>    
    </>
  );
}

export default Radio;