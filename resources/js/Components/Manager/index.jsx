import {createRoot} from "react-dom/client";
import Team from "@/Components/Manager/Team.jsx";
import Controls from "@/Components/Manager/Controls.jsx";
import {useEffect, useRef, useState} from "react";
import {axiosInstance} from "@/app.js";

export default function Manager() {
    const [minutes, setMinutes] = useState(12);
    const [seconds, setSeconds] = useState(0);
    const [timer, setTimer] = useState(false);
    const [period, setPeriod] = useState(1);

    const [score, setScore] = useState([0, 0]);
    const [shots, setShots] = useState([0, 0]);

    const isMounted = useRef(false);

    useEffect( () => {
        if (!timer)
            return;

        const interval = setInterval(() => {
            setSeconds(seconds => (seconds - 0.1).toFixed(1))
        }, 100)

        return () => {
            clearInterval(interval)
        }
    }, [timer]);

    useEffect(() => {
        if (seconds == 0 && minutes == 0) {
            setTimer(false);
        }

        if (seconds < 0 && minutes > 0) {
            setSeconds(59)
            setMinutes(minutes => minutes - 1)
        }
    }, [seconds]);

    useEffect(() => {
        if (!isMounted)
            return;

        axiosInstance.post('period', {period: period}).then(() => console.log("Period update sent to clients."))
    }, [period]);

    useEffect(() => {
        axiosInstance.get('game')
            .then(res => res.data.data)
            .then(res => {
                setMinutes(res.clock.split(":")[0]);
                setSeconds(res.clock.split(":")[1]);
                setPeriod(res.period);
                setScore([res.visitor_score, res.home_score]);
                setShots([res.visitor_shots, res.home_shots]);
            })

        Echo.channel('clock')
            .listen('.clock.started', (msg) => {
                setSeconds(msg.seconds);
                setMinutes(msg.minutes);
                setTimer(true)
            })
            .listen('.clock.stopped', (msg) => {
                setSeconds(msg.seconds);
                setMinutes(msg.minutes);
                setTimer(false)
            });

        Echo.channel('period')
            .listen('.period.update', (msg) => {
                setPeriod(msg.period)
            });

        Echo.channel('score')
            .listen('.score.update', (msg) => {
                setScore([msg.visitor_score, msg.home_score]);
            })

        Echo.channel('shots')
            .listen('.shots.update', (msg) => {
                setShots([msg.visitor_shots, msg.home_shots]);
            })

        isMounted.current = true;
    }, []);

    function changeTimer() {
        if (timer === false) {
            axiosInstance.post("/clock/start", {
                'minutes': minutes,
                'seconds': seconds
            }).then(() => console.log("Timer start pushed to clients."));
        } else {
            axiosInstance.post("/clock/stop", {
                'minutes': minutes,
                'seconds': seconds
            }).then(() => console.log("Timer stop pushed to clients."));
        }
    }

    return (
         <div style={{display: "flex", flexDirection: "column", minWidth: "100%"}}>
            <div style={{display: "flex", justifyContent: "space-evenly"}}>
                <Team goals={score[0]} shots={shots[0]} />
                <div style={{ display: "flex", flexDirection: "column", color: "white", alignItems: "center", justifyContent: "center", width: "10vw"}}>
                    <div style={{
                        fontSize: "60px",
                        backgroundColor: timer ? "green": "var(--secondary)",
                        padding: "0 1rem",
                        userSelect: "none",
                        borderRadius: "5px",
                        cursor: "pointer"
                    }} onClick={() => changeTimer()}>
                        {
                            minutes > 0 ? (
                                <>{minutes}:{String(Math.ceil(seconds)).padStart(2, "0") }</>
                            ) : (<>{seconds}</>)
                        }

                    </div>
                    <br />
                    <div style={{
                        display: "flex",
                        width: "100%",
                    }}>
                        <p style={{
                            display: "flex",
                            backgroundColor: "var(--secondary)",
                            borderRadius: "5px 0 0 5px",
                            flexGrow: 1,
                            alignItems: "center",
                            justifyContent: "center"}}>
                            Period {period}
                        </p>
                        <div style={{ backgroundColor: "green", flexGrow: 1, padding: "0.5rem 0", cursor: "pointer", textAlign: "center"}}
                             onClick={() => setPeriod(period + 1)}>
                            <i className="fa-solid fa-arrow-up"></i>
                        </div>
                        <div style={{ backgroundColor: "red", borderRadius: "0 5px 5px 0", flexGrow: 1, padding: "0.5rem 0", cursor: "pointer", textAlign: "center"}}
                             onClick={() => {if (period > 1) setPeriod(period - 1)} }>
                            <i className="fa-solid fa-arrow-down"></i>
                        </div>

                    </div>
                </div>
                <Team goals={score[1]} shots={shots[1]} />
            </div>
            <br />
            <div style={{display: "flex", justifyContent: "space-evenly", columnGap: "2vw"}}>
                <Controls homeControls={false} />

                <Controls homeControls={true} />
            </div>
        </div>
    );
}

if(document.getElementById('root')){
    createRoot(document.getElementById('root')).render(<Manager />)
}
