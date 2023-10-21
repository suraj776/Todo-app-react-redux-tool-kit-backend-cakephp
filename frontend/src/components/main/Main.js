import { Provider } from "react-redux";
import Carousel from "../sliders/Crousel";
import store from "../redux/Store";
const Main=(props)=>{
  const datas=["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
  return(
    <>
      <Provider store={store} >
      <Carousel datas={datas} isLoggedIn={props.isLoggedIn} user={props.user}/>
      </Provider>
    </>
  )
}

export default Main;