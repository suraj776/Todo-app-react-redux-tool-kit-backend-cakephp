import React from 'react'
import {Navigate, useLocation} from "react-router-dom"

const ProtectedRoute = ({children}) => {
    const user = localStorage.getItem('loginDetail')?JSON.parse(localStorage.getItem('loginDetail')):[];
    let location = useLocation();

    if(user.length<=0) {
        return <Navigate to="/signin" state={{ from: location}} replace />
    }
 return children

};

export default ProtectedRoute;