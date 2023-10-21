import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import './style.css';
const Header = (props) => {
  const [show, setShow]=useState(false);
  const showheader=()=>{
    !show?setShow(true):setShow(false);
  }
  return (
    <header>
      <div className="header-wrapper">
      <p className="brand-name-res">Productivity App</p>
        <button class="btn toggl-button" type="button" onClick={showheader}>
          <i class="fa fa-bars" aria-hidden="true"></i>
      </button>
          <div className={+ show ? "header-bar-wrapper display-none-res2":'header-bar display-none-res1'}>
          <div className="header-bar">
        <ul className="header-list">
          <li className="header-item">
            <a className="header-link brand-name">Productivity App</a>
          </li>
          <li className="header-item">
            <Link className="header-link" to={props.isLoggedIn?"/home":"/"}>Home</Link>
          </li>
        </ul>
        <ul className="header-list-auth">
          {!props.isLoggedIn && (
            <>
              <li className="header-auth-item">
              <Link className="header-button" to="/signup">SignUp</Link>
              </li>
              <li className="header-auth-item">
              <Link className="header-button" to="/signin">SignIn</Link>
              </li>
            </>
          )}
          {props.isLoggedIn && (
            <>
            <li className="header-auth-item">
              <div className="user-profile">
                <div className="user-image">
                <img src={process.env.PUBLIC_URL+'/images/profile.jpg'} alt="user"/>
                </div>
                <div className="dropdown-menu-userdetail">
                <div className="user-image mr-3">
                <img src={process.env.PUBLIC_URL+'/images/profile.jpg'} alt="user"/>
              </div>
              <div className="user-detail">
              <span className="user-detail-name">{props.user.name}</span>

              <span className="user-detail-email">{props.user.username}</span>
              <Link className="header-button mt-5 text-center" to="" onClick={props.handleLogout}>Logout</Link>

              </div>
              </div>
                </div>
              </li>
            </>
          )}
        </ul>
        </div>

          </div>

      </div>
    </header>
  );
};

export default Header;
