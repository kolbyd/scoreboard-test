export default function Team(props) {
    const {ident, logo_url, goals, shots} = props;

    return (
        <div style={{
            backgroundImage: `url("${logo_url}")`,
            backgroundRepeat: "no-repeat",
            backgroundSize: "contain",
            backgroundPosition: "center center",
            filter: "grayscale(80%)",
            flexGrow: 2,
            display: "flex",
            flexDirection: "column",
            justifyContent: "space-evenly",
            margin: "1rem",
            width: "25vw"
        }}>
            <h1 style={{color: "white", fontSize: "10vh", textAlign: "center"}}>{ident}</h1>
            <h1 style={{color: "white", fontSize: "50vh", textAlign: "center"}}>{goals}</h1>
            <h2 style={{color: "black", fontSize: "8vh", backgroundColor: "white", textAlign: "center",}}>SOG | {shots}</h2>
        </div>
    );
}
