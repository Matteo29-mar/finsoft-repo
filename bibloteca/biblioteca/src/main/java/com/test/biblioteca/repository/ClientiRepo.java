package com.test.biblioteca.Repository;
import com.test.biblioteca.Entity.Clienti;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.lang.NonNull;
import org.springframework.stereotype.Repository;

import java.util.List;
public interface ClientiRepo extends JpaRepository<Clienti, Long> {

}
