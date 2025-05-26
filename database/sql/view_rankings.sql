   CREATE OR REPLACE VIEW view_rankings AS
SELECT
    t.id AS team_id,
    t.name AS name,
    g.id AS group_id,
    g.name AS group_name,
    g.championship_id,
    ch.year,
    COUNT(DISTINCT gm.id) AS played,

    SUM(
        CASE
            WHEN (gm.team_a_id = t.id AND gm.team_a_goals > gm.team_b_goals) OR
                 (gm.team_b_id = t.id AND gm.team_b_goals > gm.team_a_goals)
            THEN 3
            WHEN gm.team_a_goals = gm.team_b_goals THEN 1
            ELSE 0
        END
    ) AS points,

    SUM(
        CASE
            WHEN gm.team_a_id = t.id THEN gm.team_a_goals
            WHEN gm.team_b_id = t.id THEN gm.team_b_goals
            ELSE 0
        END
    ) AS goalsFor,

    SUM(
        CASE
            WHEN gm.team_a_id = t.id THEN gm.team_b_goals
            WHEN gm.team_b_id = t.id THEN gm.team_a_goals
            ELSE 0
        END
    ) AS goalsAgainst,

    SUM(
        CASE
            WHEN gm.team_a_id = t.id THEN gm.team_a_goals - gm.team_b_goals
            WHEN gm.team_b_id = t.id THEN gm.team_b_goals - gm.team_a_goals
            ELSE 0
        END
    ) AS goalDifference,

    SUM(
        CASE
            WHEN (gm.team_a_id = t.id AND gm.team_a_goals > gm.team_b_goals) OR
                 (gm.team_b_id = t.id AND gm.team_b_goals > gm.team_a_goals)
            THEN 1 ELSE 0
        END
    ) AS wins,

    SUM(
        CASE
            WHEN gm.team_a_goals = gm.team_b_goals THEN 1 ELSE 0
        END
    ) AS draws,

    SUM(
        CASE
            WHEN (gm.team_a_id = t.id AND gm.team_a_goals < gm.team_b_goals) OR
                 (gm.team_b_id = t.id AND gm.team_b_goals < gm.team_a_goals)
            THEN 1 ELSE 0
        END
    ) AS losses,

    SUM(
        CASE
            WHEN gm.team_a_id = t.id THEN gm.team_a_yellow_cards + 3 * gm.team_a_red_cards
            WHEN gm.team_b_id = t.id THEN gm.team_b_yellow_cards + 3 * gm.team_b_red_cards
            ELSE 0
        END
    ) AS fair_play_points

FROM teams t
JOIN group_participations gp ON gp.team_id = t.id
JOIN groups g ON g.id = gp.group_id
JOIN championships ch ON ch.id = g.championship_id
LEFT JOIN games gm ON (
    (gm.team_a_id = t.id OR gm.team_b_id = t.id)
    AND gm.championship_id = g.championship_id
)
WHERE TYPE = 'group'
GROUP BY t.id, t.name, g.id, g.name, g.championship_id, ch.year;
