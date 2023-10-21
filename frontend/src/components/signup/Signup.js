import { useForm } from 'react-hook-form';
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import Input from "../ui/Input";
import { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import './style.css';
import ApiRequestHandler from '../../apiUtility/ApiRequestHandler';
import { apiRoutes } from '../../apiUtility/apiRoutes';
import { toast } from 'react-toastify';
function findEmail(users,value){
    let userData= users.filter((user)=>{
       return user.email==value;
     });
     return userData;
 }


  // Adding the custom validator to yup
const schema = yup.object().shape({
    name: yup.string().required('Name is required'),
    username: yup.string().email('Invalid email').required('Email is required'),
    password: yup.string().required('Password is required'),
    confirmPassword: yup
      .string()
      .oneOf([yup.ref('password'), null], 'Passwords must match')
      .required('Confirm Password is required'),
  });
const Signup = (props) => {
    const navigate = useNavigate();
    const signupApi = apiRoutes.signup;

    const submitData = async (postData) => {
      var form_data = new FormData();
        for ( var key in postData ) {
            form_data.append(key, postData[key]);
        }
      try {
        // Example POST request
        const postResponse = await ApiRequestHandler.post(signupApi.path,form_data);
        const response = postResponse.data.data;
        if(response.status=="403" && response.error){
            for (const field in response.error) {
             
              setError(field, {
                type: 'server',
                message: response.error[field][Object.keys(response.error[field])[0]],
              });
            }
        }else{
          toast.success(response.message);
          navigate("/signin");
        }
      } catch (error) {
        console.error('Error:', error);
      }
    };
    useEffect(()=>{
            if(props.isLoggedIn){
                navigate("/");
            }
    })

  const { handleSubmit, register,setError, formState: { errors }, reset } = useForm({
    resolver: yupResolver(schema),
  });
  const onSubmitHandler = (data) => {
    // let users=[];
    // users=localStorage.getItem('users')?JSON.parse(localStorage.getItem('users')):[];
    // users.push(data);
    // localStorage.setItem('users',JSON.stringify(users));
    submitData(data);
    
    // reset();
    // navigate('/signin')
  };
  return (
    <>
      <div className="signup-wrapper">
        <div className="signup-poster">
          <img
            className=""
            src={process.env.PUBLIC_URL + "/images/signup-poster.jpg"}
          />
        </div>
        <div className="signup-form-section">
          <div class="card signup-card">
            <div className="signup-card-header">
              <span>SignUp</span>
            </div>
            <div class="card-body signup-card-body">
              <form onSubmit={handleSubmit(onSubmitHandler)} className="signup-form">
                <div class="form-row">
                  <div class="form-group col-md">
                    <Input
                      type="text"
                      label="First Name"
                      name="name"
                      control={register}
                      errors={errors}
                    />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md">
                    <Input
                      type="email"
                      label="Email"
                      name="username"
                      control={register}
                      errors={errors}
                    />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md">
                    <Input
                      type="password"
                      label="Password"
                      name="password"
                      control={register}
                      errors={errors}
                    />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md">
                    <Input
                      type="password"
                      label="Confirm Password"
                      name="confirmPassword"
                      control={register}
                      errors={errors}
                    />
                  </div>
                </div>
                <div className='form-footer'>
                <button className="btn primary-button" type="submit">
                  SignUp
                </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};
export default Signup;
