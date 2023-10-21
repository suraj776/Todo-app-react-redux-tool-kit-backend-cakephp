const Input = ({ type, label, name, control, errors })=>{
    let newname=name.charAt(0).toUpperCase()+name.slice(1);
    
    return (
        <>
        <label for={`input${name}`}>{newname}</label>
        <input
        type={type}
        {...control(name)}
        className="form-control"
      />
        <p className="form-error">{errors[name]?.message}</p>

      </>
    );
}
export default Input;