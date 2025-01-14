import React, {useState} from 'react';

export default function ({ factions }) {
    const [isDemon, setIsDemon] = useState(null);
    const [capacity, setCapacity] = useState(null);
    const [grade, setGrade] = useState(null);

    const HandleFactionChange = (e) => {
        setIsDemon(e.target.value);
    }

    const HandleCapacitieChange = (e) => {
        setCapacity(e.target.value);
    }

    const HandleGradeChange = (e) => {
        setGrade(e.target.value);
    }

    return (
        <>
            <div className="mb-3">
                <label htmlFor="identite-user" className="form-label">Identité</label>
                <input type="text" className="form-control" id="identite-user" name="identite-user"/>
            </div>
            <div className="mb-3">
                <label htmlFor="pswd-user" className="form-label">Code secret</label>
                <input type="password" className="form-control" id="pswd-user" name="pswd-user"/>
            </div>
            <div className="mb-3">
                <label htmlFor="faction-user" className="form-label">Faction</label>
                <select className="form-select" id="faction-user" name="faction-user" onChange={HandleFactionChange} defaultValue={isDemon}>
                    {!isDemon && <option>Choisissez votre faction ...</option>}
                    {factions.map(faction => (
                        <option key={faction.name_faction} value={faction.id_faction}>{faction.name_faction}</option>
                    ))}
                </select>
            </div>
            {isDemon &&
                <>
                    <div className="mb-3">
                        <label htmlFor="capacitie_user" className="form-label">Souffle / Pouvoir sanguinaire</label>
                        <select className="form-select" id="capacitie_user" name="capacitie_user" onChange={HandleCapacitieChange} defaultValue={capacity}>
                            {factions.map(faction => {
                                if (faction.id_faction === isDemon) {
                                    console.log(faction.capacities_faction.name_capacity);
                                }
                                /*faction.capacities_faction.name_capacity.map(capacity => (
                                    <option key={capacity} value={capacity}>{capacity}</option>
                                ))*/
                            })}
                        </select>
                    </div>
                    <div className="mb-3">
                        <label htmlFor="grade_user" className="form-label">Grade</label>
                        <select className="form-select" id="grade_user" name="grade_user" onChange={HandleGradeChange} defaultValue={grade}>

                        </select>
                    </div>
                </>
            }
        </>
    )
}
