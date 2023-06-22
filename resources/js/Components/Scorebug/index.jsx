import {createRoot} from "react-dom/client";
import Team from "./Team.jsx";
import {useEffect, useState} from "react";
import {axiosInstance} from "../../app.js";

export default function Scorebug() {
    const [minutes, setMinutes] = useState(12);
    const [seconds, setSeconds] = useState(0);
    const [timer, setTimer] = useState(false);
    const [period, setPeriod] = useState(1);

    const [score, setScore] = useState([0, 0]);
    const [shots, setShots] = useState([0, 0]);

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
            .listen('.clock.started', msg => {
                setMinutes(msg.minutes);
                setSeconds(msg.seconds);
                setTimer(true);
            })
            .listen('.clock.stopped', msg => {
                setTimer(false);
            });

        Echo.channel('period')
            .listen('.period.update', msg => {
                setPeriod(msg.period)
            });

        Echo.channel('score')
            .listen('.score.update', (msg) => {
                setScore([msg.visitor_score, msg.home_score]);
            });

        Echo.channel('shots')
            .listen('.shots.update', (msg) => {
                setShots([msg.visitor_shots, msg.home_shots]);
            });
    }, []);

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

    return (
        <div style={{backgroundColor: "var(--secondary)", display: "flex", width: "100vw", maxHeight: "100vh"}}>
            <Team
                ident={"WPG"}
                logo_url={"https://upload.wikimedia.org/wikipedia/en/thumb/0/02/Atlanta_Thrashers.svg/1200px-Atlanta_Thrashers.svg.png"}
                shots={shots[0]}
                goals={score[0]} />
            <div style={{width: "20vw", margin: "auto 0"}}>
                <h1 style={{color: "white", textAlign: "center", fontSize: "20vh"}}>
                    {minutes > 0 ?
                        (<>{minutes}:{String(Math.ceil(seconds)).padStart(2, "0") }</>)
                        : (<>{seconds}</>)
                    }
                </h1>
                <h1 style={{color: "white", textAlign: "center", fontSize: "15vh"}}>{period}</h1>
            </div>
            <Team
                ident={"FLT"}
                logo_url={"https://seeklogo.com/images/F/flint-tropics-logo-1765AA420F-seeklogo.com.png"}
                shots={shots[1]}
                goals={score[1]} />
        </div>
    )
}

if(document.getElementById('root')){
    createRoot(document.getElementById('root')).render(<Scorebug />)
}
