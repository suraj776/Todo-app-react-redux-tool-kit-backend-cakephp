import { useForm } from "react-hook-form";
import { useNavigate } from "react-router-dom";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useEffect } from "react";
import "./style.css";
import Input from "../ui/Input";
import { apiRoutes } from "../../apiUtility/apiRoutes";
import ApiRequestHandler from "../../apiUtility/ApiRequestHandler";
import { toast } from "react-toastify";

const schema = yup.object().shape({
  username: yup.string().email("Invalid email").required("Email is required"),
  password: yup.string().required("Password is required"),
});
const Signin = (props) => {
  const navigate = useNavigate();
  const loginApi = apiRoutes.login;
  useEffect(() => {
    if (props.isLoggedIn) {
      navigate("/");
    }
  });
  const {
    handleSubmit,
    register,
    formState: { errors },
    setError,
    reset,
  } = useForm({
    resolver: yupResolver(schema),
  });
  const onSubmitHandler = async (data) => {
    var form_data = new FormData();
    for (var key in data) {
      form_data.append(key, data[key]);
    }

    try {
      const postResponse = await ApiRequestHandler.post(
        loginApi.path,
        form_data
      );
      const response = postResponse.data;
      if (response.status == "401" || response.status == "500") {
        setError("login-error", {
          type: "server",
          message: response.error,
        });
        // }
      } else {
        const token = response.data.token;
        const user = response.data.user;
        localStorage.setItem("token", token);
        localStorage.setItem("loginDetail", JSON.stringify(user));
        props.setLoggedinUser(user);
        props.setIsLoggedIn(true);
        toast.success(response.data.message);
        navigate("/home");
      }
    } catch (error) {
      setError("login-error", {
        type: "server",
        message: error.error,
      });
      console.error("Error:", error);
    }
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
              <span>SignIn</span>
            </div>
            <div class="card-body signup-card-body">
              <p className="form-error">{errors["login-error"]?.message}</p>
              <form
                onSubmit={handleSubmit(onSubmitHandler)}
                className="signup-form"
              >
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
                <div className="form-footer">
                  <button className="btn primary-button" type="submit">
                    SignIn
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
export default Signin;
