import React, { useState } from 'react';

export default function ({ factions }) {
    const [selectedFaction, setSelectedFaction] = useState(null);
    const [capacity, setCapacity] = useState(null);
    const [grade, setGrade] = useState(null);

    const handleFactionChange = (e) => {
        const factionId = parseInt(e.target.value, 10);
        setSelectedFaction(factions.find(faction => faction.id_faction === factionId));
        setCapacity(null);
        setGrade(null);
    };

    const handleCapacitieChange = (e) => {
        setCapacity(e.target.value);
    };

    const handleGradeChange = (e) => {
        setGrade(e.target.value);
    };

    return (
        <>
            <div className="mb-3">
                <label htmlFor="name-user" className="form-label">Identité</label>
                <input type="text" className="form-control" id="name-user" name="name-user" required/>
            </div>
            <div className="mb-3">
                <label htmlFor="pswd-user" className="form-label">Code secret</label>
                <input type="password" className="form-control" id="pswd-user" name="pswd-user" required/>
            </div>
            <div className="mb-3">
                <label htmlFor="faction-user" className="form-label">Faction</label>
                <select className="form-select" id="faction-user" name="faction-user" onChange={handleFactionChange} defaultValue="" required>
                    <option value="" disabled>Choisissez votre faction ...</option>
                    {factions.map(faction => (
                        <option key={faction.id_faction} value={faction.id_faction}>
                            {faction.name_faction}
                        </option>
                    ))}
                </select>
            </div>
            {selectedFaction && (
                <>
                    <div className="mb-3">
                        <label htmlFor="capacity-user" className="form-label">Souffle / Pouvoir sanguinaire</label>
                        <select className="form-select" id="capacity-user" name="capacity-user" onChange={handleCapacitieChange} value={capacity || ""} required>
                            <option value="" disabled>Choisissez votre souffle / pouvoir sanguinaire...</option>
                            {selectedFaction.capacities_faction.name_capacitie.map((cap, index) => (
                                <option key={index} value={cap}>{cap}</option>
                            ))}
                        </select>
                    </div>
                    <div className="mb-3">
                        <label htmlFor="grade-user" className="form-label">Grade</label>
                        <select className="form-select" id="grade-user" name="grade-user" onChange={handleGradeChange} value={grade || ""} required>
                            <option value="" disabled>Choisissez votre grade...</option>
                            {selectedFaction.grades_faction.name_grade.map((grd, index) => (
                                <option key={index} value={grd}>{grd}</option>
                            ))}
                        </select>
                    </div>
                </>
            )}
        </>
    );
}