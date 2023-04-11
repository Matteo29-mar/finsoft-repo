package com.stage.biblioteca.repository.prestiti;

import com.stage.biblioteca.entity.prestiti.Prestiti;
import org.springframework.data.jpa.repository.JpaRepository;

public interface PrestitiRepo extends JpaRepository<Prestiti, Integer> {
}
