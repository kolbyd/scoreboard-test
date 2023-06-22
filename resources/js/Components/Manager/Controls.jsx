import Button from "@/Components/Manager/Button.jsx";
import {axiosInstance} from "@/app.js";

export default function Controls(props) {
    const {homeControls} = props;

    function sendScore(value) {
        axiosInstance.post(`score/${homeControls ? "home" : "visitor"}`, {
            score: value
        })
    }

    function sendShots(value) {
        axiosInstance.post(`shots/${homeControls ? "home" : "visitor"}`, {
            shots: value
        })
    }

    return (
        <div style={{display: "flex", justifyContent: "space-evenly",  gap: "6px", flexGrow: 1, flexWrap: "wrap"}}>
            <Button name={"Score +1"} callback={() => sendScore(1)} />
            <Button name={"Score -1"} callback={() => sendScore(-1)} />
            <Button name={"SOG +1"} callback={() => sendShots(1)} />
            <Button name={"SOG -1"} callback={() => sendShots(-1)} />
        </div>
    );
}
