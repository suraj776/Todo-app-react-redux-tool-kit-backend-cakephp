import logo from "./logo.svg";
import "./App.css";
import Signup from "./components/signup/Signup";
import Signin from "./components/signup/Signin";
import Main from "./components/main/Main";
import { useEffect, useState } from "react";
import Header from "./components/header/Header";
import { Route, Routes, useNavigate } from "react-router-dom";
import ProtectedRoute from "./components/utils/Protected";
import GuestMain from "./components/main/GuestMain";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
function App() {
  const navigate = useNavigate();
  const [isLoggedIn, setIsLoggedIn] = useState(
    localStorage.getItem("loginDetail") ? true : false
  );
  const [loggedinUser, setLoggedinUser] = useState(
    localStorage.getItem("loginDetail")
      ? JSON.parse(localStorage.getItem("loginDetail"))
      : {}
  );

  const handleLogout = () => {
    localStorage.removeItem("loginDetail");
    localStorage.removeItem("token");
    setIsLoggedIn(false);
    setLoggedinUser({});
    window.location.href = "/";
  };
  return (
    <>
      <Header
        isLoggedIn={isLoggedIn}
        handleLogout={handleLogout}
        user={loggedinUser}
      />
      <div className="page-wrapper">
        <Routes>
          <Route
            path="/"
            element={<GuestMain isLoggedIn={isLoggedIn} user={loggedinUser} />}
          />
          <Route
            path="/home"
            element={
              <ProtectedRoute>
                <Main isLoggedIn={isLoggedIn} user={loggedinUser} />
              </ProtectedRoute>
            }
          />
          <Route path="/signup" element={<Signup isLoggedIn={isLoggedIn} />} />
          <Route
            path="/signin"
            element={
              <Signin
                setIsLoggedIn={setIsLoggedIn}
                isLoggedIn={isLoggedIn}
                setLoggedinUser={setLoggedinUser}
              />
            }
          />
        </Routes>
        <ToastContainer
          position="bottom-right"
          autoClose={2000}
          hideProgressBar={false}
          newestOnTop={false}
          closeOnClick
          rtl={false}
          pauseOnFocusLoss
          draggable
          pauseOnHover
          theme="light"
        />
      </div>
    </>
  );
}

export default App;
