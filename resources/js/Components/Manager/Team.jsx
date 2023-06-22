import {useEffect, useState} from "react";
import {axiosInstance} from "@/app.js";

export default function Team(props) {
    const {goals, shots} = props;

    const [ team, setTeam ] = useState(null)
    const [ allTeams, setAllTeams ] = useState([])

    useEffect(() => {
        axiosInstance
            .get('/teams')
            .then((res) => {
                setAllTeams(res.data.data)
            })
    }, [])

    return (
        <div style={{display: "flex", flexDirection: "column", justifyContent: "center", alignItems: "center", color: "white"}}>
            <select onChange={(change) => setTeam(allTeams[change.target.selectedIndex - 1])}
            style={{ background: "none", border: "none"}} defaultValue="-1">
                <option disabled={true} hidden={true} value="-1">Select a team...</option>
                {
                    allTeams.length > 0 && allTeams.map((team) => (
                        <option key={team.id} style={{ backgroundColor: "var(--primary)", color: "black" }}>{team.full_name}</option>
                    ))
                }
            </select>
            <br />
            <img src={team ? team.logo_url : ""} style={{width: "15vw", height: "auto"}} alt=""/>

            <br />
            <p>Score: {goals} | SOG: {shots}</p>
        </div>
    );
}
