SELECT TO_CHAR(d.day, 'Month DD, YYYY') AS log_date,
    COALESCE(COUNT(h.emp_id), 0) AS encoded,
    a.emp_id,
    a.h_fullname
FROM (
        SELECT DATE '2025-1-01' + INTERVAL '1 day' * (n - 1) AS day
        FROM (
                SELECT generate_series(
                        1,
                        CAST(
                            DATE_PART(
                                'days',
                                DATE_TRUNC('month', CURRENT_DATE) + INTERVAL '1 month - 1 day'
                            ) AS INTEGER
                        )
                    ) AS n
            ) AS numbers
    ) AS d
    LEFT JOIN his_tracking_logs h ON h.log_date::date = d.day
    AND h.emp_id = '7642'
    AND h.log_details LIKE '%Forwarded%'
    LEFT JOIN his_account a ON a.emp_id = h.emp_id
GROUP BY d.day,
    a.emp_id,
    a.h_fullname
ORDER BY d.day;
