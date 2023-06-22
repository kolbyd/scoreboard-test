export default function Button(props) {
    const { name, callback } = props;

    return (
        <button className="btn" onClick={callback}>{name}</button>
    )
}
